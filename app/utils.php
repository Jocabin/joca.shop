<?php
function get_db(): ?PDO {
        $sqlite_file = __DIR__ . '/database.sqlite';
        try {
                $conn = new PDO("sqlite:" . $sqlite_file);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
        } catch (PDOException $exception) {
                exception_handler($exception);
                return null;
        }
}

function route_with_params(string $str): bool {
        global $request_context;
        $parts = explode('/', $str);
        $static_parts = [];
        $match_results = [];

        foreach ($parts as $idx => $p) {
                if (str_starts_with($p, '[') && str_ends_with($p, ']')) {
                        $parts[$idx] = '[^\s]+';
                } else {
                        $static_parts[] = $p;
                }
        }

        $pattern = '#^' . join('/', $parts) . '#';
        $is_matched = preg_match($pattern, $_SERVER['REQUEST_URI'], $match_results) ? true : false;

        if ($is_matched === true) {
                $matched_route = explode('/', $match_results[0]);
                $parts = explode('/', $str);

                for ($i = 0; $i < count($parts); $i += 1) {
                        if ($parts[$i] !== $matched_route[$i]) {
                                $key = trim(trim($parts[$i], '['), ']');
                                $request_context['route_params'][$key] = $matched_route[$i];
                        }
                }
        }

        return $is_matched;
}

function page_not_found(): void {
        global $request_context;
        http_response_code(404);
        load_template('404');
        $request_context['content'] = ob_get_clean();
        exit();
}

function title(string $str): void {
        global $request_context;
        $request_context['page_title'] =  "joca.shop | " . $str;
}

function fetch_json(string $url): mixed {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $data;
}

function exception_handler($throwable): void {
        global $request_context;
        $request_context['content'] = 'Error: ' . $throwable->getMessage() . ' in ' . $throwable->getFile() . ' on line ' . $throwable->getLine() . PHP_EOL;
}

function add_route(&$router, string $path, string $method, callable $cb, bool $is_route_dynamic = false): void {
        $router[$method . ':' . $path] = [
                'path' => $path,
                'method' => $method,
                'callback' => $cb,
                'is_route_dynamic' => $is_route_dynamic
        ];
}

function match_route($router, string $incoming_route): void {
        global $request_context;
        if (str_ends_with($incoming_route, '/') && strlen($incoming_route) > 1) {
                $incoming_route = substr_replace($incoming_route, '', -1);
        }

        $url = parse_url($incoming_route);

        ob_start();
        $matched = false;

        foreach ($router as $r) {
                if ($url['path'] === $r['path'] || (route_with_params($r['path']) && $r['is_route_dynamic'])) {
                        if ($_SERVER['REQUEST_METHOD'] !== $r['method']) {
                                throw new Exception('Incorrect method.');
                        }

                        $matched = true;
                        $r['callback']();
                        break;
                }
        }

        if (!$matched) {
                title('Page not found.');
                http_response_code(404);
                load_template('404');
        }

        $request_context['content'] = ob_get_clean();
}

function load_template(string $path) {
        require __DIR__ . '/views/' . $path . '.php';
}

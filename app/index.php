<?php
$route = $_SERVER['REQUEST_URI'];
$route_params = [];
$page_title = '';
$hxRequest = isset($_SERVER['HTTP_HX_REQUEST']) && $_SERVER['HTTP_HX_REQUEST'] == 'true';

register_shutdown_function(function () {
        global $content, $hxRequest, $viewDir, $page_title;
        if ($hxRequest) {
                echo $content;
        } else {
                require __DIR__ . '/views/_layout.php';
        }
});

function exception_handler($throwable): void
{
        global $content;
        $content = 'Error: ' . $throwable->getMessage() . ' in ' . $throwable->getFile() . ' on line ' . $throwable->getLine() . PHP_EOL;
}
set_exception_handler('exception_handler');

function get_sqlite_connection(): ?PDO
{
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

function route_with_params(string $str): bool
{
        global $route, $route_params;
        $pattern = '';
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
        $is_matched = preg_match($pattern, $route, $match_results) ? true : false;

        if ($is_matched === true) {
                $matched_route = explode('/', $match_results[0]);
                $parts = explode('/', $str);

                for ($i = 0; $i < count($parts); $i += 1) {
                        if ($parts[$i] !== $matched_route[$i]) {
                                $key = trim(trim($parts[$i], '['), ']');
                                $route_params[$key] = $matched_route[$i];
                        }
                }
        }

        return $is_matched;
}

function page_not_found(): void
{
        global $content;
        http_response_code(404);
        require __DIR__  . '/views/404.php';
        $content = ob_get_clean();
        die;
}

function fetch_json(string $url): mixed
{
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $data;
}

ob_start();
if (str_ends_with($route, '/')) {
        $route = substr_replace($route, '', -1);
}

switch ($route) {
        case '':
        case '/':
                $page_title = 'joca.shop | We are the best.';
                require __DIR__ . '/views/home.php';
                break;

        case '/about':
                $page_title = 'joca.shop | About us.';
                require __DIR__ . '/views/about.php';
                break;

        case route_with_params('/products/[id]'):
                require __DIR__ . '/views/product_detail.php';
                break;

                // case '/htmx':
                //         echo '<p>hello</p>';
                //         break;

        default:
                $page_title = 'joca.shop | Page not found.';
                http_response_code(404);
                require __DIR__ . '/views/404.php';
}
$content = ob_get_clean();

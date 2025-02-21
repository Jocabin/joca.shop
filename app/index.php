<?php
$router = [];
$request_context = [
        'page_title' => '',
        'hx_request' => isset($_SERVER['HTTP_HX_REQUEST']) && $_SERVER['HTTP_HX_REQUEST'] == 'true',
        'route_params' => [],
        'content' => '',
        'data' => []
];

require __DIR__ . "/utils.php";

register_shutdown_function(function () {
        global $request_context;

        if ($request_context['hx_request']) {
                echo $request_context['content'];
        } else {
                load_template('_layout');
        }
});
set_exception_handler('exception_handler');

add_route($router, '/', 'GET', function () {
        global $request_context;
        $products = fetch_json("https://fakestoreapi.com/products");
        $request_context['data']['products'] = $products;

        title('We are the best.');
        load_template('home');
        // header("HTTP/1.1 304 Not Modified");
});
add_route($router, '/products', 'GET', function () {
        header('Location: /', true, 301);
        exit();
});
add_route($router, '/products/[id]', 'GET', function () {
        global $request_context;
        $product = fetch_json("https://fakestoreapi.com/products/" . $request_context['route_params']['id']);

        if (!isset($product['id'])) {
                page_not_found();
        }

        $request_context['data']['product'] = $product;

        title($product['title']);
        load_template('product_detail');
}, $is_route_dynamic = true);
add_route($router, '/about', 'GET', function () {
        title('About this site.');
        load_template('about');
});
add_route($router, '/cart', 'GET', function () {
        title('Your cart.');
        load_template('cart');
});
add_route($router, '/add-to-cart', 'POST', function () {
        $product_id = $_POST['product_id'];
        $is_product_in_cart = isset($_SESSION['cart'][$product_id]);

        if ($is_product_in_cart) {
                unset($_SESSION['cart'][$product_id]);
                echo 'Buy for ' . $_POST['product_price'] . '€';
        } else {
                $cart_item = [
                        'id' => $product_id,
                        'name' => $_POST['product_name'],
                        'image' => $_POST['product_image'],
                        'description' => $_POST['product_description'],
                        'price' => $_POST['product_price']
                ];
                $_SESSION['cart'][$product_id] = $cart_item;
                echo 'Remove product from cart';
        }
        echo '<a id="cart_link" hx-swap-oob="#cart_link" class="link" href="/cart">Cart(' . count($_SESSION['cart']) . ')</a>';
});
add_route($router, '/checkout', 'GET', function () {
        global $request_context;

        $cart = $_SESSION['cart'];
        if (empty($cart)) {
                header('Location: /', true, 302);
        }

        $cart_total = 0;
        foreach ($cart as $item) {
                $cart_total += $item['price'];
        }
        $request_context['data']['cart_total'] = $cart_total;

        title('Proceed to checkout');
        load_template('checkout');
});
add_route($router, '/submit-checkout', 'POST', function () {
        // todo: validate form infos, and show error messages
        // todo: create db entry for the order table
});

session_start();
if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
}
match_route($router, $_SERVER['REQUEST_URI']);

<?php
$product = fetch_json("https://api.escuelajs.co/api/v1/products/" . $route_params['id'] . "?limit=10&offset=0");

if (isset($product['error'])) {
        page_not_found();
}
?>

<p>Nom du produit: <?= $product['title'] ?></p>
<?php
$product = fetch_json("https://api.escuelajs.co/api/v1/products/" . $route_params['id'] . "?limit=10&offset=0");
$_SESSION['product'] = $product;
$_SESSION['img_index'] = 0;

if (isset($product['error'])) {
        page_not_found();
}

$page_title = 'joca.shop | ' . $product['title'] . '.';
?>

<div class="flex flex-col justify-start items-center gap-4 p-8">
        <div class="flex flex-col justify-center items-center">
                <div id="product_img" class="max-w-[500px] max-h-[500px] bg-gray-100 rounded overflow-hidden">
                        <img src="<?= $product['images'][$_SESSION['img_index']] ?>" alt="<?= $product['description'] ?>" width="500" height="500">
                </div>

                <nav class="flex justify-center items-center gap-8 w-full p-4">
                        <button class="link" hx-get="/htmx/product-img?dir=prev" hx-target="#product_img" hx-swap="innerHTML">Précédent</button>
                        <button class="link" hx-get="/htmx/product-img?dir=next" hx-target="#product_img" hx-swap="innerHTML">Suivant</button>
                </nav>
        </div>

        <p class="text-2xl font-bold"><?= $product['title'] ?></p>

        <form action="/add-to-cart" method="post" class="flex flex-row justify-start items-end gap-4">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" name="product_name" value="<?= $product['title'] ?>">
                <input type="hidden" name="product_price" value="<?= $product['price'] ?>">

                <button type="submit" class="button">Buy for <?= $product['price'] ?>€</button>
        </form>
</div>
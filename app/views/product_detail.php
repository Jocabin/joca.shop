<?php
global $request_context;
$product = $request_context['data']['product'];
$is_product_in_cart = isset($_SESSION['cart'][$product['id']]);
?>

<div class="w-full flex flex-col justify-center items-center gap-4 p-8">
        <div class="flex flex-col justify-center items-center">
                <div id="product_img" class="max-w-[500px] max-h-[500px] bg-gray-100 rounded overflow-hidden">
                        <img src="<?= $product['image'] ?>" alt="<?= $product['description'] ?>" width="500" height="500">
                </div>
        </div>

        <p class="text-2xl font-bold"><?= $product['title'] ?></p>

        <form hx-post="/add-to-cart" class="flex flex-row justify-start items-end gap-4" hx-target="#buy_button">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" name="product_name" value="<?= $product['title'] ?>">
                <input type="hidden" name="product_image" value="<?= $product['image'] ?>">
                <input type="hidden" name="product_description" value="<?= $product['description'] ?>">
                <input type="hidden" name="product_price" value="<?= $product['price'] ?>">

                <button type="submit" class="button" id="buy_button">
                        <?php if (!$is_product_in_cart): ?>
                                Buy for <?= $product['price'] ?>€
                        <?php else: ?>
                                Remove product from cart
                        <?php endif; ?>
                </button>
        </form>
</div>
<?php
$is_cart_empty = empty($_SESSION['cart']);
$cart = $_SESSION['cart'];
$cart_total = 0;

foreach ($cart as $item) {
        $cart_total += $item['price'];
}
?>

<div class="w-full">
        <h1 class="text-center h1 my-8">Your cart.</h1>
        <?php if (empty($cart)): ?>
                <p class="text-center">Your cart is empty. See our products <a href="/" class="link">here</a>.</p>
        <?php else: ?>
                <ul class="flex flex-row justify-center items-center gap-16 flex-wrap px-8">
                        <?php foreach ($cart as $item): ?>
                                <li>
                                        <a href="/products/<?= $item['id'] ?>" class="link max-w-[400px] max-h-[400px] flex flex-col justify-center items-center gap-4">
                                                <img src="<?= $item['image'] ?>" alt="<?= $item['description'] ?>" width="200" height="200" class="object-contain p-4 w-[200px] h-[200px]">
                                                <span class="text-center"><?= $item['name'] ?></span>
                                                <span class="text-center font-bold"><?= $item['price'] ?>€</span>
                                        </a>
                                </li>
                        <?php endforeach; ?>
                </ul>

                <div class="w-full sticky bottom-0 bg-gray-100 p-8 my-8 flex flex-col justify-center items-center gap-4">
                        <p>Total price: <span class="font-bold"><?= $cart_total ?>€</span></p>
                        <a class="button" href="/checkout">Proceed to checkout</a>
                </div>
        <?php endif; ?>
</div>
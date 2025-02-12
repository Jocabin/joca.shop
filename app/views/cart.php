<?php
$is_cart_empty = empty($_SESSION['cart']);
$cart = $_SESSION['cart'];
$cart_total = 0;

foreach ($cart as $item) {
        $cart_total += $item['price'];
}
?>

<div>
        <ul class="flex flex-row justify-center items-center gap-16 flex-wrap">
                <?php foreach ($cart as $item): ?>
                        <li>
                                <a href="/products/<?= $item['id'] ?>" class="link max-w-[400px] max-h-[400px] flex flex-col justify-center items-center gap-4">
                                        <img src="<?= $item['image'] ?>" alt="<?= $item['description'] ?>" width="200" height="200" class="object-contain p-4 w-[200px] h-[200px]">
                                        <span class="text-center"><?= $item['name'] ?></span>
                                </a>
                        </li>
                <?php endforeach; ?>
        </ul>

        <div class="w-full sticky bottom-0 bg-gray-100 p-8 my-8 flex flex-col justify-center items-center gap-4">
                <p>Total price: <span class="font-bold"><?= $cart_total ?>€</span></p>
                <a class="button" href="/checkout">Proceed to checkout</a>
        </div>
</div>
<?php
$cart_count = count($_SESSION['cart']);
?>

<header class="w-full flex flex-row justify-between items-center gap-4 p-8 border-b border-gray-200 sticky top-0 bg-white">
        <nav class="flex flex-row justify-between items-center gap-4">
                <a class="link" href="/">Products</a>
                <a class="link" href="/about">About</a>
        </nav>
        <a id="cart_link" class="link" href="/cart">Cart(<?= $cart_count ?>)</a>
</header>
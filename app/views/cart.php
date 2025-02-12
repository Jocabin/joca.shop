<?php
$is_cart_empty = empty($_SESSION['cart']);
$cart = $_SESSION['cart'];
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
</div>
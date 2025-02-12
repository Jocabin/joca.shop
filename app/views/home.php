<?php
global $request_context;
$products = $request_context['data']['products'];
?>

<section class="w-full h-full">
        <ul class="products_grid p-8 w-full gap-16">
                <?php foreach ($products as $product): ?>
                        <li>
                                <a
                                        href="/products/<?= $product['id'] ?>"
                                        class="max-w-[200px] h-full flex justify-start items-center flex-col border border-gray-200 hover:border-gray-500 rounded">
                                        <img src="<?= $product["image"] ?>" alt="<?= $product["description"] ?>" width="200" height="200" class="object-contain p-4 max-w-[200px] max-h-[200px]">
                                        <p class="text-center p-4"><?= $product["title"]; ?></p>
                                </a>
                        </li>
                <?php endforeach; ?>
        </ul>
</section>

<style>
        .products_grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                justify-items: center;
        }
</style>
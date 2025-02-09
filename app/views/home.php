<?php
$products = fetch_json("https://api.escuelajs.co/api/v1/products?limit=28&offset=0");
?>

<section>
        <ul class="products_grid p-8 w-full gap-16">
                <?php foreach ($products as $product): ?>
                        <li>
                                <a
                                        href="/products/<?= $product['id'] ?>"
                                        class="max-w-[200px] h-full flex justify-start items-center flex-col border border-gray-200 hover:border-gray-500 rounded">
                                        <img src="<?= $product["images"][0] ?>" alt="<?= $product["description"] ?>" width="200" height="200">
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
<?php
$products = fetch_json("https://api.escuelajs.co/api/v1/products?limit=10&offset=0");
?>

<section>
        <ul class="flex flex-row gap-4 flex-wrap p-8">
                <?php foreach ($products as $product): ?>
                        <li class="flex flex-col gap-4">
                                <a href="/products/<?= $product['id'] ?>">
                                        <img src="<?= $product["images"][0] ?>" alt="<?= $product["description"] ?>" width="100" height="100">
                                        <p><?= $product["title"]; ?></p>
                                </a>
                        </li>
                <?php endforeach; ?>
        </ul>
</section>
<?php
global $request_context;
$products = $request_context['data']['products'];
?>

<?php
// $conn = get_db();
// if (!$conn) {
//         echo "Failed to establish a connection to the local SQLite database." . PHP_EOL;
// }

// $stmt = $conn->prepare("SELECT * FROM products");
// $stmt->execute();
// $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($result as $row) {
//         echo $row['id'] . ' - ' . $row['name'] . PHP_EOL;
// }
?>

<section class="w-full h-full p-8">
        <h1 class="h1 text-center mb-8">Our products.</h1>

        <ul class="products_grid w-full gap-16">
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
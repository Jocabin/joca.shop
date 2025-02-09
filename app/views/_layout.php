<!-- todo: optimiser selon la vidéo de wesbos -->

<!DOCTYPE html>
<html lang="fr">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $page_title ?></title>
        <meta name="description" content="A simplest but functionnal e-commerce website." />
        <link rel="icon" type="image/svg+xml" href="/public/favicon.svg" />
        <link rel="preload" href="/public/roboto.woff2" as="font" type="font/woff2" crossorigin />
        <link rel="stylesheet" href="/public/styles.css">
        <!-- todo: use tailwind cli for production -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
</head>

<body class="flex flex-col justify-between items-center h-full min-h-screen">
        <?php include(__DIR__ . '/../components/header.php'); ?>

        <main class="w-full h-full"><?= $content; ?></main>

        <footer class="flex justify-center items-center p-8">
                <p>&copy; <a href="/">joca.shop</a>&nbsp;-&nbsp;<?= date('Y'); ?></p>
        </footer>
</body>

</html>
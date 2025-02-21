<?php global $request_context; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $request_context['page_title'] ?></title>
        <meta name="description" content="A simplest but functionnal e-commerce website." />
        <link rel="icon" type="image/svg+xml" href="/public/favicon.svg" />
        <link rel="preload" href="/public/roboto.woff2" as="font" type="font/woff2" crossorigin />
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <link rel="stylesheet" href="/public/styles.css">
        <style type="text/tailwindcss">
                .button {
                        @apply border border-gray-300 px-4 py-2 rounded hover:bg-gray-200 cursor-pointer;
                }
                .input {
                        @apply border border-gray-300 px-4 py-2 rounded;
                }
                .link {
                        @apply underline hover:no-underline uppercase cursor-pointer;
                }
                .h1 {
                        @apply font-bold text-2xl;
                }
        </style>
        <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
</head>

<body class="flex flex-col justify-between items-center h-full min-h-screen">
        <?php include(__DIR__ . '/../components/header.php'); ?>

        <main class="w-full h-full flex-1 flex items-stretch"><?= $request_context['content']; ?></main>

        <footer class="flex justify-center items-center p-8">
                <p>&copy; <a href="/">joca.shop</a>&nbsp;-&nbsp;<?= date('Y'); ?></p>
        </footer>
</body>

</html>
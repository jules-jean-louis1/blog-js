<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="resources/js/scriptIndex.js"></script>
    <link rel="stylesheet" href="resources/style/index.css">
    <title>Blog</title>
</head>
<body>
<header class="border-b-[1px] border-[#52586633]">
    <?php include_once 'resources/assests/import/header.php' ?>
</header>
    <main>
        <div id="formDisplayer"></div>
        <div id="test">
            <h2 class="text-6xl text-center text-blue-400">
                Hello World
            </h2>
        </div>
    </main>
</body>
</html>
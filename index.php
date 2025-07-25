<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta name="robots" content="index, follow">
    <meta name="description" content="WebElementsLab — большая библиотека сниппетов, UI-элементов и готовых решений на HTML, CSS и JavaScript для веб-разработчиков. Копируйте, скачивайте и внедряйте лучшие примеры для своих проектов!">
    <meta name="keywords" content="HTML, CSS, JS, сниппеты, UI, веб-разработка, компоненты, примеры, шаблоны, frontend, элементы, дизайн, код, WebElementsLab">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>WebElementsLab — лучшие HTML, CSS и JS сниппеты для веб-разработчиков</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <meta property="og:title" content="WebElementsLab — лучшие сниппеты и UI-элементы для веба">
    <meta property="og:description" content="Библиотека сниппетов, UI и компонентов для современных сайтов. Быстрое внедрение, удобный поиск, свежие решения для разработчиков.">
    <meta property="og:image" content="https://webelementslab.ru/assets/img/logo512.png">
    <meta property="og:url" content="https://webelementslab.ru/">
    <meta property="og:type" content="website">

</head>
<body>
    <?php require_once __DIR__ . '/templates/header.php'; ?>
    <div class="wrapper">
        <main>
        <section class="slogan">
            <h1>WebElementsLab — <br>Готовые HTML, CSS и JS решения</h1><br>
            <h2>Подпишитесь на обновления и получайте свежие сниппеты первыми</h2>
        </section>
        <div class="sub-block">
            <input class="inp-sub" type="email" name="subcribeemail" id="subcribeemail" autocomplete="email" placeholder="Ваша почта...">
            <button class="sub-btn" id="sub-btn">Подписаться</button>
        </div>
        <!-- тут будет лента с карточками -->
        <!-- <div>
                <a href="/card.php">Карточка</a>
                <a href="/card.php?id=2">Карточка с id 2</a>
        </div> -->
         <h1 class="ldp-admin-title">Здравствуйте, <?= htmlspecialchars($_SESSION['username'] ?? 'Гость') ?></h1>
        <!-- Лента карточек -->
        <div id="snippets-list"></div>
        <!-- JS вынесен в assets/js/main.js -->
    </div>
    <?php require_once __DIR__ . '/templates/footer.php'; ?>
    <script src="/assets/js/main.js" defer></script>
</body>
</html>
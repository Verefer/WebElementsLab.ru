<?php
// guide.php — страница с инструкцией по подключению CSS и JS
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta name="robots" content="index, follow">
    <meta name="description" content="Гайд по подключению CSS и JS: примеры, рекомендации, лучшие практики для веб-разработчиков.">
    <meta name="keywords" content="CSS, JS, подключение, инструкция, гайд, WebElementsLab, frontend, скрипты, стили, best practices">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>Гайд: как подключать CSS и JS | WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <meta property="og:title" content="Гайд: как подключать CSS и JS">
    <meta property="og:description" content="Подробная инструкция по подключению стилей и скриптов в HTML. Внутренние и внешние способы, советы и примеры.">
    <meta property="og:image" content="https://webelementslab.ru/assets/img/logo512.png">
    <meta property="og:url" content="https://webelementslab.ru/guide.php">
    <meta property="og:type" content="article">
</head>
<body>
<div class="wrapper">
<?php require_once __DIR__ . '/templates/header.php'; ?>
<main class="guide-main">
    <h1>Гайд: как правильно подключать CSS и JS</h1>
    <p>В этом гайде вы узнаете, как подключать стили и скрипты к вашему проекту:</p>
    <h2>1. Внешнее подключение CSS</h2>
    <pre><code>&lt;link rel="stylesheet" href="/assets/css/style.css"&gt;</code></pre>
    <h2>2. Внутренний CSS прямо в HTML</h2>
    <pre><code>&lt;style&gt;
/* Ваш CSS-код */
body { background: #fff; }
&lt;/style&gt;</code></pre>
    <h2>3. Внешнее подключение JS</h2>
    <pre><code>&lt;script src="/assets/js/script.js" defer&gt;&lt;/script&gt;</code></pre>
    <h2>4. JS прямо в HTML</h2>
    <pre><code>&lt;script&gt;
// Ваш JS-код
console.log('Hello!');
&lt;/script&gt;</code></pre>
    <h2>5. Рекомендации</h2>
    <ul>
        <li>Для больших проектов используйте внешние файлы — это ускоряет загрузку и облегчает поддержку.</li>
        <li>Внутренний код удобно для быстрых тестов и небольших решений.</li>
        <li>Старайтесь подключать JS с атрибутом <code>defer</code> или <code>async</code> для ускорения загрузки страницы.</li>
    </ul>
    <p>Больше примеров и советов — на <a href="https://developer.mozilla.org/ru/docs/Web/HTML/Element/link" target="_blank">MDN</a>.</p>
</main>
<?php require_once __DIR__ . '/templates/footer.php'; ?>
</div>
</body>
</html>

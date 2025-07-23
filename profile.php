<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: /login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <!--
    <meta name="robots" content="..."> — управляет поведением поисковых систем на странице.

    Возможные значения:
    index        — разрешить индексировать страницу (по умолчанию)
    noindex      — запретить индексировать страницу (не попадёт в поисковую выдачу)

    follow       — разрешить переход по ссылкам и индексировать их (по умолчанию)
    nofollow     — запретить переход по ссылкам и их индексацию

    all          — то же самое, что index, follow (явное разрешение)
    none         — то же самое, что noindex, nofollow (полный запрет)

    noarchive    — запретить поисковикам сохранять копию страницы (кэш)
    nosnippet    — запретить показывать сниппет (описание) в поиске
    notranslate  — запретить показывать кнопку перевода в поисковой выдаче
    noimageindex — запретить индексировать изображения на странице

    ✅ Примеры:
    <meta name="robots" content="index, follow">           — стандартное поведение
    <meta name="robots" content="noindex, nofollow">       — полностью скрыть страницу
    <meta name="robots" content="noarchive, nosnippet">    — не кэшировать и не показывать описание
    <meta name="robots" content="noindex, follow">         — не индексировать, но переходить по ссылкам

    Совет: можно задать директивы только для конкретных ботов, например:
    <meta name="googlebot" content="noindex, nofollow">  -->
    <meta name="robots" content="index, follow">
    <meta name="description" content="Профиль пользователя WebElementsLab">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>WebElementsLab — HTML, CSS и JS сниппеты для веб-разработчиков</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <meta property="og:title" content="WebElementsLab — HTML/CSS/JS элементы">
    <meta property="og:description" content="Готовые сниппеты и UI для твоих проектов.">
    <meta property="og:image" content="https://webelementslab.ru/assets/img/logo512.png">
    <meta property="og:url" content="https://webelementslab.ru/">
    <meta property="og:type" content="website">

</head>
<body>
    <?php require_once __DIR__ . '/templates/header.php'; ?>
    <div class="wrapper">
        <main>
        <h1>Профиль <?= htmlspecialchars($_SESSION['username'] ?? 'Гость') ?></h1>
        <h2>Дизайн ещё не разработан</h2>
        <a href="/logout.php" class="reg-btn anim-hover-box-shadow">Выход</a>
        </main>
    </div>
    <?php require_once __DIR__ . '/templates/footer.php'; ?>


</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta
      name="description"
      content="content">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>Переменная | WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="wrapper">
<?php require_once __DIR__ . '/templates/header.php'; ?>
<main>
    <div class="d-flex gap1 card-page f-d-column">
        <div class="d-flex j-c-space-between">
            <h2>Название</h2>
            <h2>Автор</h2>
        </div>
        <div class="f-d-row d-flex gap1">
            <div class="left-card-page d-flex gap1 f-d-column">
                <div class="block-element d-flex j-c-center a-i-center">
                    <a class="btn" href="#">BUTTON</a>
                </div>
                <div class="d-flex gap1 f-d-column">
                    <a class="btn-card j-c-center d-flex" href="#">Избранное</a>
                    <a class="btn-card j-c-center d-flex" href="#">Подписаться</a>
                </div>
            </div>
            <div class="block-code">
                <p>Сюда как-то реализовать код</p>
            </div>
        </div>
        <div>
            <p>Короткая информация с ссылками на то как подключать стили</p>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/templates/footer.php'; ?>
</div>
</body>
</html>
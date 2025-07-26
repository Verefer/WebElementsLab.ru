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
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Страница не найдена - WebElementsLab">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>404 - Страница не найдена | WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/pages/404.css">
</head>
<body>
        <main class="block-main">
            <div class="error-container">
                <h1 class="error-code">404</h1>
                <h2 class="error-title">Страница не найдена</h2>
                <p class="error-description">
                    К сожалению, запрашиваемая страница не существует или была перемещена. 
                    Возможно, вы перешли по устаревшей ссылке или допустили ошибку в адресе.
                </p>
                <div class="error-actions">
                    <button onclick="window.location.href='/'" class="error-btn">Вернуться на главную</button>
                    <button onclick="history.back()" class="error-btn">Назад</button>
                </div>
            </div>
        </main>
</body>
</html> 
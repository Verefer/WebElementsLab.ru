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
    <meta name="description" content="Библиотека сниппетов и UI-элементов на HTML, CSS и JS. Скачивайте, копируйте и используйте готовые решения для своих проектов.">
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
        <section class="slogan">
            <h1>WebElementsLab — <br>Готовые HTML, CSS и JS решения</h1><br>
            <h2>Подпишитесь на обновления и получайте свежие сниппеты первыми</h2>
        </section>
        <div class="sub-block">
            <input class="inp-sub" type="email" data-type="custom-email" name="subcribeemail" id="subcribeemail" autocomplete="email" placeholder="Ваша почта...">
            <button class="sub-btn" id="sub-btn">Подписаться</button>
        </div>

        <script>
            document.getElementById('sub-btn').addEventListener('click', function () {
                const email = document.getElementById('subcribeemail').value.trim();

                if (email !== '') {
                    const encodedEmail = encodeURIComponent(email);
                    window.location.href = `/register.php?email=${encodedEmail}`;
                } else {
                    alert('Введите почту перед подпиской!');
                }
            });
        </script>
                <!-- тут будет лента с карточками -->
        <div>
                <a href="/card.php">Карточка</a>
        </div>
         <h1 class="ldp-admin-title">Здравствуйте, <?= htmlspecialchars($_SESSION['username'] ?? 'Гость') ?></h1>
        </main>
    </div>
    <?php require_once __DIR__ . '/templates/footer.php'; ?>


</body>
</html>
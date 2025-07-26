<?php
session_start();

// Получаем id пользователя для просмотра профиля
if (!empty($_GET['id'])) {
    $user_id = (int)$_GET['id'];
} elseif (!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    // Если не авторизован и не указан id — редирект на логин
    header('Location: /pages/login.php');
    exit;
}

require_once __DIR__ . '/../includes/db.php';

// Получаем профиль пользователя
$stmt = $pdo->prepare('SELECT * FROM user_profiles WHERE user_id = ? LIMIT 1');
$stmt->execute([$user_id]);
$profile = $stmt->fetch();

// Получаем информацию о пользователе
$stmt = $pdo->prepare('SELECT username, email FROM users WHERE id = ? LIMIT 1');
$stmt->execute([$user_id]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta name="robots" content="index, follow">
    <meta name="description" content="Профиль пользователя WebElementsLab">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>WebElementsLab — HTML, CSS и JS сниппеты для веб-разработчиков</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/pages/profile.css">
    <meta property="og:title" content="WebElementsLab — HTML/CSS/JS элементы">
    <meta property="og:description" content="Готовые сниппеты и UI для твоих проектов.">
    <meta property="og:image" content="https://webelementslab.ru/assets/img/logo512.png">
    <meta property="og:url" content="https://webelementslab.ru/">
    <meta property="og:type" content="website">

</head>
<body>
    <?php require_once __DIR__ . '/../templates/header.php'; ?>
    <div class="wrapper">
        <main>
        <section class="block-main">
            <!-- Фоновое изображение -->
            <div class="profile-bg" 
                style="background-image: url('<?= !empty($profile['bg-img-url']) ? htmlspecialchars($profile['bg-img-url']) : '/assets/img/default-bg.jpg' ?>');">
            </div>

            <div class="profile-avatar">
                <img src="<?= !empty($profile['avatar_url']) ? htmlspecialchars($profile['avatar_url']) : '/assets/img/default-avatar.png' ?>" alt="Аватар" />
            </div>

            <div class="profile-info">
                <h1><?= htmlspecialchars($user['username'] ?? 'Гость') ?></h1>
                <p class="profile-email">Email: <span><?= htmlspecialchars($user['email'] ?? '') ?></span></p>
                <p class="profile-bio">О себе: <span><?= htmlspecialchars($profile['bio'] ?? '') ?></span></p>

                <div class="profile-socials">
                    <?php if (!empty($profile['vk'])): ?>
                        <a href="https://vk.com/<?= htmlspecialchars($profile['vk']) ?>" class="profile-social vk" title="VK" target="_blank" rel="noopener"></a>
                    <?php endif; ?>

                    <?php if (!empty($profile['tg'])): ?>
                        <a href="https://t.me/<?= htmlspecialchars($profile['tg']) ?>" class="profile-social tg" title="Telegram" target="_blank" rel="noopener"></a>
                    <?php endif; ?>

                    <?php if (!empty($profile['github'])): ?>
                        <a href="https://github.com/<?= htmlspecialchars($profile['github']) ?>" class="profile-social gh" title="GitHub" target="_blank" rel="noopener"></a>
                    <?php endif; ?>
                </div>

                <a href="/pages/logout.php" class="reg-btn anim-hover-box-shadow">Выход</a>
            </div>
        </section>

            <script>
                document.querySelectorAll('.profile-social').forEach(btn => {
                btn.addEventListener('mouseup', e => btn.blur());
                btn.addEventListener('mouseleave', e => btn.blur());
                });
            </script>
        </main>
    </div>
    <?php require_once __DIR__ . '/../templates/footer.php'; ?>


</body>
</html>
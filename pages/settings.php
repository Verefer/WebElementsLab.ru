<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['id'])) {
    header('Location: /pages/login.php');
    exit;
}

$user_id = $_SESSION['id'];

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avatar_url = trim($_POST['avatar_url'] ?? '');
    $bg_img_url = trim($_POST['bg_img_url'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $vk = trim($_POST['vk'] ?? '');
    $tg = trim($_POST['tg'] ?? '');
    $github = trim($_POST['github'] ?? '');

    // Обновим или создадим профиль
    $stmt = $pdo->prepare("SELECT id FROM user_profiles WHERE user_id = ?");
    $stmt->execute([$user_id]);

    if ($stmt->fetch()) {
        $stmt = $pdo->prepare("UPDATE user_profiles SET avatar_url = ?, 'bg-img-url' = ?, bio = ?, vk = ?, tg = ?, github = ? WHERE user_id = ?");
        $stmt->execute([$avatar_url, $bg_img_url, $bio, $vk, $tg, $github, $user_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO user_profiles (user_id, avatar_url, `bg-img-url`, bio, vk, tg, github) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $avatar_url, $bg_img_url, $bio, $vk, $tg, $github]);
    }

    $success = true;
}

// Получаем текущие данные профиля
$stmt = $pdo->prepare("SELECT * FROM user_profiles WHERE user_id = ?");
$stmt->execute([$user_id]);
$profile = $stmt->fetch() ?: [];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Настройки профиля — WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/pages/settings.css">
</head>
<body>
    <?php require_once __DIR__ . '/../templates/header.php'; ?>
    <div class="wrapper">
        <main>
            <section class="block-main">
                <h1>Настройки профиля</h1>
                <?php if (!empty($success)): ?>
                    <p class="success">Профиль успешно обновлён ✅</p>
                <?php endif; ?>

                <form method="POST" class="profile-settings-form">
                    <label>
                        Аватар (URL):
                        <input type="url" name="avatar_url" value="<?= htmlspecialchars($profile['avatar_url'] ?? '') ?>">
                    </label>

                    <label>
                        Фон (URL):
                        <input type="url" name="bg_img_url" value="<?= htmlspecialchars($profile['bg-img-url'] ?? '') ?>">
                    </label>

                    <label>
                        О себе:
                        <textarea name="bio" rows="4"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea>
                    </label>

                    <label>
                        VK:
                        <input type="text" name="vk" placeholder="username" value="<?= htmlspecialchars($profile['vk'] ?? '') ?>">
                    </label>

                    <label>
                        Telegram:
                        <input type="text" name="tg" placeholder="username" value="<?= htmlspecialchars($profile['tg'] ?? '') ?>">
                    </label>

                    <label>
                        GitHub:
                        <input type="text" name="github" placeholder="username" value="<?= htmlspecialchars($profile['github'] ?? '') ?>">
                    </label>

                    <button type="submit" class="reg-btn anim-hover-box-shadow">Сохранить</button>
                </form>
            </section>
        </main>
    </div>
    <?php require_once __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>

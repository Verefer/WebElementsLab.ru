<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['id'])) {
    header('Location: /pages/login.php');
    exit;
}

$user_id = $_SESSION['id'];

// Получаем избранные сниппеты
$stmt = $pdo->prepare('
    SELECT s.id, s.title, s.description
    FROM favorites f
    JOIN snippets s ON s.id = f.snippet_id
    WHERE f.user_id = ?
    ORDER BY f.created_at DESC
');
$stmt->execute([$user_id]);
$favorites = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Избранное — WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/pages/favorites.css">
</head>
<body>
<?php require_once __DIR__ . '/../templates/header.php'; ?>
<div class="wrapper">
    <main>
        <section class="block-main">
            <h1>Избранное</h1>
            <?php if (empty($favorites)): ?>
                <p>Вы ещё не добавили ни одного сниппета в избранное.</p>
            <?php else: ?>
                <div class="favorites-list">
                    <?php foreach ($favorites as $snippet): ?>
                        <div class="snippet-card">
                            <h3><?= htmlspecialchars($snippet['title']) ?></h3>
                            <p><?= htmlspecialchars($snippet['description']) ?></p>
                            <a href="/pages/card.php?id=<?= $snippet['id'] ?>" class="reg-btn anim-hover-box-shadow">Открыть</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>

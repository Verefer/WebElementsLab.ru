<?php
require_once 'includes/auth_check.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Админка - Dashboard</title>
<link rel="stylesheet" href="assets/admin_style.css" />
</head>
<body>
<nav class="ldp-menu">
    <a href="index.php?page=dashboard">Главная</a> 
    <a href="index.php?page=menu_edit">Меню</a> 
    <a href="includes/logout.php">Выйти</a>
</nav>

<div class="ldp-admin-block">
<h1 class="ldp-admin-title">Здравствуйте, <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Гость') ?></h1>
    <p class="ldp-admin-text">Добро пожаловать в админ-панель.</p>
</div>
</body>
</html>

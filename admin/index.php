<?php
session_start();

// Защита от неавторизованных
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: includes/login.php');
    exit;
}

$page = $_GET['page'] ?? 'dashboard';

// Безопасный список допустимых страниц
$allowed_pages = [
    'dashboard'     => 'templates/dashboard.php',
    'menu_edit'     => 'templates/menu_edit.php',
];

if (array_key_exists($page, $allowed_pages)) {
    require $allowed_pages[$page];
} else {
    echo "<h2>Страница не найдена</h2>";
}

<?php
session_start(); // обязательно стартуем сессию

// Удаляем все данные сессии
$_SESSION = [];

// Если используешь куки сессии — удаляем их
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Наконец, уничтожаем сессию
session_destroy();

// Перенаправляем пользователя, например, на главную
header('Location: /');
exit;
?>

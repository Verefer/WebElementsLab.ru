<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Вход в админку</title>

</head>
<body>
<h2>Вход в админку</h2>
<?php if (!empty($error)): ?>
<p style="color:red;"><?=htmlspecialchars($error)?></p>
<?php endif; ?>
<form method="post" action="includes/login.php">
    <label>Логин:<br><input type="text" name="username" required></label><br>
    <label>Пароль:<br><input type="password" name="password" required></label><br>
    <button type="submit">Войти</button>
</form>
</body>
</html>

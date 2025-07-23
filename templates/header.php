<header>
        <div class="nav-left">
            <img src=assets/img/logo.svg class="logo-header" alt="logo">
            <a href="/">Главная</a>
            <a href="/login.php">Вход</a>
            <a href="/register.php">Регистрация</a>
            <a href="/card.php">Карточка</a>
        </div>
        <div class="nav-right">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Привет, <?= htmlspecialchars($_SESSION['username']) ?></span>
            <a href="/logout.php" class="reg-btn anim-hover-box-shadow">Выход</a>
        <?php else: ?>
            <a href="/login.php">Вход</a>
            <a class="reg-btn anim-hover-box-shadow" href="/register.php">Регистрация</a>
        <?php endif; ?>
    </div>
    </header>
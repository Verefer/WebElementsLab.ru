<header>
        <div class="nav-left">
            <img src="/assets/img/logo.svg" class="logo-header" alt="logo">
            <a href="/">Главная</a>
            <a href="/pages/login.php">Вход</a>
            <a href="/pages/register.php">Регистрация</a>
            <a href="/pages/card.php">Карточка</a>
        </div>
        <div class="nav-right">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Привет, <a href="/pages/profile.php"><?= htmlspecialchars($_SESSION['username']) ?></a></span>
            <a href="/pages/logout.php" class="reg-btn anim-hover-box-shadow">Выход</a>
        <?php else: ?>
            <a href="/pages/login.php">Вход</a>
            <a class="reg-btn anim-hover-box-shadow" href="/pages/register.php">Регистрация</a>
        <?php endif; ?>
    </div>
    </header>
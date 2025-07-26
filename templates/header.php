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
            <div class="profile-menu-wrapper" id="profileWrapper">
                <img src="/assets/img/default-avatar.png" alt="avatar" class="avatar" id="avatarToggle">
                <div class="dropdown-menu" id="profileMenu">
                    <span class="menu-username"><?= htmlspecialchars($_SESSION['username']) ?></span>
                    <a href="/pages/profile.php">Профиль</a>
                    <a href="/pages/settings.php">Настройки</a>
                    <a href="/pages/favorites.php">Избранное</a>
                    <a href="/pages/logout.php" class="logout-link">Выход</a>
                </div>
            </div>
        <?php else: ?>
            <a href="/pages/login.php">Вход</a>
            <a class="reg-btn anim-hover-box-shadow" href="/pages/register.php">Регистрация</a>
        <?php endif; ?>
    </div>
</header>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const avatarToggle = document.getElementById('avatarToggle');
    const profileMenu = document.getElementById('profileMenu');
    const profileWrapper = document.getElementById('profileWrapper');

    let menuOpen = false;

    function toggleMenu(forceClose = false) {
        if (forceClose || menuOpen) {
            profileMenu.classList.remove('show');
            menuOpen = false;
        } else {
            profileMenu.classList.add('show');
            menuOpen = true;
        }
    }

    avatarToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleMenu();
    });

    // Закрытие при клике вне
    document.addEventListener('click', (e) => {
        if (!profileWrapper.contains(e.target)) {
            toggleMenu(true);
        }
    });

    // Закрытие по Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            toggleMenu(true);
        }
    });

    // Закрытие, если мышка ушла с меню и аватарки
    let hoverTimeout;

    profileWrapper.addEventListener('mouseleave', () => {
        hoverTimeout = setTimeout(() => {
            toggleMenu(true);
        }, 400);
    });

    profileWrapper.addEventListener('mouseenter', () => {
        clearTimeout(hoverTimeout);
    });
});
</script>

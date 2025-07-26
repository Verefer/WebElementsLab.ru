<?php
if (isset($_SESSION['id'])) {
    require_once __DIR__ . '/../includes/db.php';
    $stmt = $pdo->prepare('SELECT avatar_url FROM user_profiles WHERE user_id = ? LIMIT 1');
    $stmt->execute([$_SESSION['id']]);
    $user_profile = $stmt->fetch();
    $avatar_url = !empty($user_profile['avatar_url']) ? $user_profile['avatar_url'] : '/assets/img/default-avatar.png';
}
?>


<header>
    <div class="nav-left">
        <a href="/">
            <img src="/assets/img/logo.svg" class="logo-header" alt="logo">
        </a>
        <a href="/">Главная</a>
        <a href="/pages/login.php">Вход</a>
        <a href="/pages/register.php">Регистрация</a>
        <a href="/pages/card.php">Карточка</a>
    </div>
    <div class="nav-right">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="profile-menu-wrapper" id="profileWrapper">
                <span class="username-label"><?= htmlspecialchars($_SESSION['username']) ?></span>
                <img src="<?= $avatar_url ?>" alt="avatar" class="avatar" id="avatarToggle">
                <div class="dropdown-menu" id="profileMenu">
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

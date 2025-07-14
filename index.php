<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <!-- Верхняя панель -->
    <header>
        <nav>
            <ul>
                <li><a href="#">Главная</a></li>
                <li><a href="#">Новости</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
        </nav>
    </header>
    
    <!-- Боковая панель -->
    <aside>
        <h3>Меню</h3>
        <ul id="sidebar-menu">
            <li><a href="#" data-tag="all">Все записи</a></li>
            <li><a href="#" data-tag="news">Новости</a></li>
            <li><a href="#" data-tag="articles">Статьи</a></li>
            <li><a href="#" data-tag="photos">Фотографии</a></li>
        </ul>
    </aside>
    
    <!-- Основной контент -->
    <main id="content">
        <div class="post">
            <p>Пост №1</p>
        </div>
        <div class="post">
            <p>Пост №2</p>
        </div>
        <div class="post">
            <p>Пост №3</p>
        </div>
    </main>
</div>
<script src="script.js"></script>
</body>
</html>
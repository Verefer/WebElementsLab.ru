<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth_check.php';

$editDish = null;
$actionAdd = false;

if (isset($_GET['action']) && $_GET['action'] === 'add') {
    $actionAdd = true;
} elseif (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM dishes WHERE dish_id = ?");
    $stmt->execute([$id]);
    $editDish = $stmt->fetch(PDO::FETCH_ASSOC);
}

$dishes = $pdo->query("SELECT * FROM dishes ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

$categories = [
    'Холодные закуски',
    'Салаты',
    'Супы',
    'Паста',
    'Горячие закуски',
    'Пицца',
    'Рыба',
    'Мясо',
    'Гарниры',
    'Мангал',
    'Соусы',
    'Хлеб',
    'Десерты'
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Админка - Меню</title>
<link rel="stylesheet" href="assets/admin_style.css" />
</head>
<body>
<nav class="ldp-menu">
    <a href="index.php?page=dashboard">Главная</a> 
    <a href="index.php?page=booking">Бронирования</a> 
    <a href="index.php?page=news_edit">Новости</a> 
    <a href="index.php?page=menu_edit">Меню</a> 
    <a href="includes/logout.php">Выйти</a>
</nav>

<h2 class="ldp-admin-title">Меню ресторана</h2>

<!-- Ссылка для добавления -->
<h3><a href="index.php?page=menu_edit&action=add">Добавить новое блюдо</a></h3>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>Название</th><th>Категория</th><th>Цена</th><th>Вес (г)</th><th>Изображение</th><th>Создано</th><th>Действия</th>
    </tr>
    <?php foreach ($dishes as $dish): ?>
        <tr>
            <td><?= htmlspecialchars($dish['dish_id']) ?></td>
            <td><?= htmlspecialchars($dish['title']) ?></td>
            <td><?= htmlspecialchars($dish['category']) ?></td>
            <td><?= number_format($dish['price'], 2) ?> ₽</td>
            <td><?= (int)$dish['weight'] ?></td>
            <td>
                <?php if ($dish['image']): ?>
                    <img src="/uploads/<?= htmlspecialchars($dish['image']) ?>" alt="" width="80">
                <?php endif; ?>
            </td>
            <td><?= $dish['created_at'] ?></td>
            <td>
                <a href="index.php?page=menu_edit&edit=<?= $dish['dish_id'] ?>">✏️</a>
                <a href="includes/handlers/menu_delete.php?id=<?= $dish['dish_id'] ?>" onclick="return confirm('Удалить блюдо?')">🗑️</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Модальное окно -->
<?php if ($actionAdd || $editDish): ?>
<div id="modal" class="modal" style="display: block;">
    <section class="modal-content">
        <form action="includes/handlers/menu_save.php" method="post" enctype="multipart/form-data">
            <div class="form">
                <span class="close" onclick="window.location.href='index.php?page=menu_edit'">&times;</span>
                <h3><?= $editDish ? "Редактировать блюдо #{$editDish['dish_id']}" : 'Добавить новое блюдо' ?></h3>

                <?php if ($editDish): ?>
                    <input type="hidden" name="dish_id" value="<?= htmlspecialchars($editDish['dish_id']) ?>">
                <?php endif; ?>

                <label>Название:
                    <input type="text" name="title" value="<?= htmlspecialchars($editDish['title'] ?? '') ?>" required>
                </label>

                <label>Описание:
                    <textarea name="description" rows="4" required><?= htmlspecialchars($editDish['description'] ?? '') ?></textarea>
                </label>

                <label>Категория:
                    <select name="category" required>
                        <option value="" disabled <?= empty($editDish['category']) ? 'selected' : '' ?>>Выберите категорию</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat ?>" <?= ($editDish['category'] ?? '') === $cat ? 'selected' : '' ?>>
                                <?= $cat ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label>Цена (₽):
                    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($editDish['price'] ?? '') ?>" required>
                </label>

                <label>Вес (г):
                    <input type="number" name="weight" value="<?= htmlspecialchars($editDish['weight'] ?? '') ?>" required>
                </label>

                <label>Изображение: 
                  <?php if (empty($editDish)): ?>
                    <span style="color: red;">*</span>
                  <?php endif; ?>
                  <input 
                    type="file" 
                    name="image" 
                    accept="image/*" 
                    <?= empty($editDish) ? 'required' : '' ?>
                  >
                  <?php if (!empty($editDish) && !empty($editDish['image'])): ?>
                    <img src="/uploads/<?= htmlspecialchars($editDish['image']) ?>" width="100" alt="">
                  <?php endif; ?>
                </label>
                <button type="submit"><?= $editDish ? 'Сохранить' : 'Добавить' ?></button>
            </div>
        </form>
    </section>
</div>

<script>
  // Просто чтобы модалка была видна, opacity можно убрать, если есть стили
  document.querySelector('.modal').style.opacity = 1;
</script>
<?php endif; ?>

</body>
</html>

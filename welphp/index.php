<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta
      name="description"
      content="Web site Web Elements Lab">
    <link rel="apple-touch-icon" href="assets/img/logo192.png" >
    <title>WebElementsLab</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php require_once 'includes/header.php'; ?>
    <div class="wrapper">
        <main>
        <div class="slogan">
            <h1>Большой первый слоган - <br> на две строки хотябы</h1>
            <h3>Подпишитесь на наши обновления, чтобы всегда первыми узнавать о новинках</h3>
        </div>
        <div class="sub-block">
            <input type="email" name="subcribeemail" id="subcribeemail" placeholder="Ваша почта...">
            <button class="sub-btn" id="sub-btn">Подписаться</button>
            <script>
                document.getElementById('sub-btn').addEventListener('click', function () {
                    window.location.href = 'register.php';
                });
            </script>
        </div>

        <div>
    <!-- Внешний вид карточек -->
        </div>
        </main>
    </div>
    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
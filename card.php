<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/img/favicon.ico" >
    <meta name="theme-color" content="#000000" >
    <meta
      name="description"
      content="content">
    <link rel="apple-touch-icon" href="/assets/img/logo192.png" >
    <title>Переменная | WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="wrapper">
<?php require_once __DIR__ . '/templates/header.php'; ?>
<main>
    <div class="d-flex gap1 card-page f-d-column">
        <div class="d-flex j-c-space-between">
            <h2>Название</h2>
            <h2>Автор</h2>
        </div>
        <div class="f-d-row d-flex gap1">
            <div class="left-card-page d-flex gap1 f-d-column">
                <div class="f-d-row d-flex gap1">
                <!-- Preview -->
                <div class="left-card-page d-flex gap1 f-d-column">
                    <div class="block-element d-flex j-c-center a-i-center">
                    <a class="btn" href="#">BUTTON</a> <!-- Живой результат -->
                    </div>
                    <div class="d-flex gap1 f-d-column">
                    <a class="btn-card j-c-center d-flex" href="#">Избранное</a>
                    <a class="btn-card j-c-center d-flex" href="#">Подписаться</a>
                    </div>
                </div>

                <!-- Code Tabs -->
                <div class="block-code">
                    <div class="tabs d-flex gap05">
                    <button class="tab-btn active" data-tab="html">HTML</button>
                    <button class="tab-btn" data-tab="css">CSS</button>
                    <button class="tab-btn" data-tab="js">JS</button>
                    </div>

                    <div class="tab-content active" id="html">
                    <pre><code class="language-html">&lt;a class="btn" href="#"&gt;BUTTON&lt;/a&gt;</code></pre>
                    </div>
                    <div class="tab-content" id="css">
                    <pre><code class="language-css">.btn { background: #000; color: #fff; padding: 0.5em 1em; }</code></pre>
                    </div>
                    <div class="tab-content" id="js">
                    <pre><code class="language-js">document.querySelector('.btn').onclick = () => alert('Нажато');</code></pre>
                    </div>
                </div>
                </div>


        </div>
        <div>
            <p>Короткая информация с ссылками на то как подключать стили</p>
        </div>
    </div>
    <script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const id = btn.dataset.tab;
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.toggle('active', content.id === id);
        });
        });
    });
    </script>

</main>
<?php require_once __DIR__ . '/templates/footer.php'; ?>
</div>
</body>
</html>
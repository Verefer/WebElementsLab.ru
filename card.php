<?php
session_start();
require_once __DIR__ . '/includes/db.php'; // если ещё не подключал

$id = $_GET['id'] ?? 1;

$stmt = $pdo->prepare("SELECT s.*, u.username FROM snippets s JOIN users u ON s.id_user = u.id WHERE s.id_card = ?");
$stmt->execute([$id]);
$snippet = $stmt->fetch();

if (!$snippet) {
    die('Сниппет не найден');
}
?>

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
    <title><?= htmlspecialchars($snippet['name']) ?> | WebElementsLab</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- Prism CSS -->
    <link href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism.min.css" rel="stylesheet" />
    <!-- Prism JS -->
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js" defer></script>
    <!-- Языки -->
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-css.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-javascript.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-markup.min.js" defer></script>

</head>
<body>
<div class="wrapper">
<?php require_once __DIR__ . '/templates/header.php'; ?>
<main>
    <div class="d-flex gap1 card-page f-d-column">
        <div class="d-flex j-c-space-between">
        <h2><?= htmlspecialchars($snippet['name']) ?></h2>
        <h2><?= htmlspecialchars($snippet['username']) ?></h2>
        </div>
        <div class="f-d-row d-flex gap1">
            <!-- Preview -->
            <div class="left-card-page d-flex gap1 f-d-column">
                <div class="block-element d-flex j-c-center a-i-center">
                    <?= $snippet['html'] ?>
                    <style><?= $snippet['css'] ?></style>
                    <script><?= $snippet['js'] ?></script>
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
                    <button class="copy-btn">Копировать</button>
                    <pre><code class="language-html"><?= htmlspecialchars($snippet['html']) ?></code></pre>
                </div>
                <div class="tab-content" id="css">
                    <button class="copy-btn">Копировать</button>
                    <pre><code class="language-css"><?= htmlspecialchars($snippet['css']) ?></code></pre>
                </div>
                <div class="tab-content" id="js">
                    <button class="copy-btn">Копировать</button>
                    <pre><code class="language-js"><?= htmlspecialchars($snippet['js']) ?></code></pre>
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
<script src="/assets/js/snippet.js" defer></script>
</body>
</html>
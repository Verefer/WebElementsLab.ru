<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр кода с подсветкой</title>
    
    <!-- Подключение Prism.js для подсветки синтаксиса -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-html.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .code-section {
            margin: 20px 0;
            position: relative;
        }

        .code-block {
            background: #282c34;
            color: #abb2bf;
            padding: 1.5rem;
            border-radius: 8px;
            font-family: 'Fira Code', monospace;
            font-size: 14px;
            line-height: 1.8;
            position: relative;
        }

        .line-numbers {
            user-select: none;
            padding: 1.5rem 10px;
            margin-right: 10px;
            width: 30px;
            background: #30363e;
            text-align: right;
            display: inline-block;
        }

        .copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 8px 16px;
            background: #444;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .copy-btn:hover {
            background: #555;
        }
    </style>
</head>
<div class="code-section">
    <div class="code-block" data-language="html">
        <pre><code class="language-html">&lt;a class="btn" href="#"&gt;BUTTON&lt;/a&gt;</code></pre>
    </div>
    <button class="copy-btn">Копировать</button>
</div>
<script>
import Prism from 'prismjs';
import 'prismjs/components/prism-css';
import 'prismjs/components/prism-javascript';
import 'prismjs/components/prism-html';

// Функция для загрузки кода из БД
async function loadCode(language) {
    try {
        const response = await fetch(`/api/code?language=${language}`);
        const code = await response.text();
        
        const codeBlock = document.querySelector(`.code-block[data-language="${language}"]`);
        codeBlock.innerHTML = `<pre><code class="language-${language}">${code}</code></pre>`;
        
        Prism.highlightAll();
    } catch (error) {
        console.error('Ошибка загрузки кода:', error);
    }
}

// Функция копирования
document.querySelectorAll('.copy-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const codeBlock = btn.closest('.code-section').querySelector('.code-block');
        const code = codeBlock.textContent;
        
        try {
            await navigator.clipboard.writeText(code);
            alert('Код скопирован!');
        } catch (error) {
            console.error('Ошибка копирования:', error);
        }
    });
});
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подсветка кода</title>
    <style>
        /* Основной контейнер для кода */
        .code-container {
            background-color: #282c34;
            padding: 20px;
            border-radius: 8px;
            overflow: auto;
            position: relative;
        }

        /* Стили для превью кода */
        .code-preview {
            color: white;
            font-family: 'Fira Code', monospace;
            font-size: 16px;
            line-height: 1.6;
            white-space: pre-wrap;
            word-break: break-all;
        }

        /* Подсветка регистров */
        .uppercase {
            color: #c678dd; /* Фиолетовый для заглавных букв */
            font-weight: bold;
        }

        .lowercase {
            color: #e5c07b; /* Желтый для строчных букв */
        }

        /* Стили для кнопок копирования */
        .copy-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #444;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .copy-button:hover {
            background-color: #555;
        }

        .tabs {
            width: 100%;
            display: inline-block;
        }

        .tab-list {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .tab-item {
            display: inline-block;
            margin-right: 10px;
            padding: 10px;
            cursor: pointer;
            background-color: #f1f1f1;
            border-radius: 5px 5px 0 0;
            transition: background-color 0.3s;
        }

        .tab-item.active {
            background-color: white;
        }

        .tab-item:hover {
            background-color: #e0e0e0;
        }

        .tab-content {
            border: 1px solid #f1f1f1;
            padding: 20px;
            border-radius: 5px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

    </style>
</head>
<body>
    <div class="tabs">
    <ul class="tab-list">
        <li class="tab-item active" data-tab="tab1">Вкладка 1</li>
        <li class="tab-item" data-tab="tab2">Вкладка 2</li>
        <li class="tab-item" data-tab="tab3">Вкладка 3</li>
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <h3>Содержимое вкладки 1</h3>
            <p>Здесь будет первый блок контента</p>
        </div>
        
        <div class="tab-pane" id="tab2">
            <h3>Содержимое вкладки 2</h3>
            <p>Здесь будет второй блок контента</p>
        </div>
        
        <div class="tab-pane" id="tab3">
            <h3>Содержимое вкладки 3</h3>
            <p>Здесь будет третий блок контента</p>
        </div>
    </div>
</div>

    <div class="code-container">
        <button class="copy-button" onclick="copyCode()">Копировать</button>
        <pre class="code-preview" id="code-preview">
            <span class="uppercase">function</span> example() {
                <span class="lowercase">console.log('Hello, World!');</span>
            }
        </pre>
    </div>

    <script>
        function copyCode() {
            const code = document.getElementById('code-preview').innerText;
            navigator.clipboard.writeText(code)
                .then(() => {
                    alert('Код скопирован!');
                })
                .catch(err => {
                    console.error('Ошибка при копировании:', err);
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
    var tabItems = document.querySelectorAll('.tab-item');
    
    tabItems.forEach(function(tab) {
        tab.addEventListener('click', function() {
            var tabId = this.getAttribute('data-tab');
            var content = document.getElementById(tabId);
            
            // Удаляем активный класс у текущих вкладок и контента
            document.querySelector('.tab-item.active').classList.remove('active');
            document.querySelector('.tab-pane.active').classList.remove('active');
            
            // Добавляем активный класс для выбранной вкладки и контента
            this.classList.add('active');
            content.classList.add('active');
        });
    });
});

    </script>
</body>
</html>

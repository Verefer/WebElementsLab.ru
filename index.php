<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Социальная сеть с бесконечной лентой</title>
    <style>
        /* Базовые настройки */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70px;
            background-color: #4a76a8;
            color: white;
            font-size: 24px;
        }

        #feed-container {
            width: 60%;
            max-width: 800px;
            margin: auto;
            padding-top: 20px;
        }

        .post {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .post-header {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .post-image img {
            width: 100%;
            object-fit: cover;
        }

        .post-text {
            padding: 15px;
        }

        .loader {
            text-align: center;
            margin-top: 20px;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .spinner {
            animation: spin 1s linear infinite;
            border: 4px solid transparent;
            border-top-color: #4a76a8;
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
    <!-- Шапка сайта -->
    <div class="header">
        <h1>Моя социальная сеть</h1>
    </div>

    <!-- Основная лента новостей -->
    <div id="feed-container"></div>

    <script>
        // Тестовый набор постов
        const posts = [
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Иван Иванов',
                image: 'https://via.placeholder.com/300x200',
                text: 'Привет всем! Сегодня отличная погода.'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Марья Сидорова',
                image: null,
                text: 'Посмотрите новый фильм про космос!'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Сергей Петров',
                image: 'https://via.placeholder.com/300x200',
                text: 'Новый альбом моей любимой группы наконец вышел!'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Анна Кузнецова',
                image: null,
                text: 'Кто-нибудь видел вчерашний матч?'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Дмитрий Смирнов',
                image: 'https://via.placeholder.com/300x200',
                text: 'Наконец-то посетил музей современного искусства!'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Елена Васильева',
                image: null,
                text: 'Сегодня приготовила вкусный пирог!'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Алексей Орлов',
                image: 'https://via.placeholder.com/300x200',
                text: 'Отдыхал на даче и сделал классные снимки природы.'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Светлана Иванова',
                image: null,
                text: 'Подскажите хорошую книгу для чтения на ночь.'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Павел Егоров',
                image: 'https://via.placeholder.com/300x200',
                text: 'Катался на велосипеде утром — заряд бодрости на целый день!'
            },
            {
                avatar: 'https://via.placeholder.com/50',
                author: 'Ольга Сергеева',
                image: null,
                text: 'Собираюсь посетить выставку современных художников.'
            }
        ];

        let currentPage = 1;
        const postsPerPage = 10;

        // Рендерим посты
        function renderPosts(postsData) {
            const feedContainer = document.getElementById('feed-container');
            postsData.forEach((post) => {
                let postHTML = `
                    <div class="post">
                        <div class="post-header">
                            <img src="${post.avatar}" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;" />
                            <span>${post.author}</span>
                        </div>
                        ${post.image ? `<div class="post-image"><img src="${post.image}" /></div>` : ''}
                        <div class="post-text">${post.text}</div>
                    </div>
                `;
                feedContainer.insertAdjacentHTML("beforeend", postHTML);
            });
        }

        // Имитация задержки при получении данных
        async function fetchMorePosts() {
            return new Promise(resolve => {
                setTimeout(() => {
                    resolve(posts.slice(currentPage * postsPerPage, (currentPage + 1) * postsPerPage));
                }, 1000);
            });
        }

        // Бесконечная подгрузка постов при скролле
        let isLoading = false;
        document.addEventListener('scroll', async () => {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && !isLoading) {
                isLoading = true;
                showLoader(); // Показываем лоадер
                
                try {
                    const morePosts = await fetchMorePosts();
                    
                    if (morePosts.length > 0) {
                        renderPosts(morePosts);
                        currentPage++; // Следующая страница
                    } else {
                        console.log('Больше постов нет.');
                    }
                } catch(error) {
                    console.error('Ошибка загрузки:', error.message);
                } finally {
                    hideLoader(); // Убираем лоадер
                    isLoading = false;
                }
            }
        });

        // Индикация загрузки
        function showLoader() {
            const loaderDiv = document.createElement('div');
            loaderDiv.classList.add('loader');
            loaderDiv.innerHTML = '<div class="spinner"></div>';
            document.body.appendChild(loaderDiv);
        }

        function hideLoader() {
            const loaderDiv = document.querySelector('.loader');
            if (loaderDiv) {
                loaderDiv.remove();
            }
        }

        // Первоначальное отображение первой порции постов
        renderPosts(posts.slice(0, postsPerPage));
    </script>
</body>
</html>
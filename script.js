// Масштабируемый список постов
const posts = [
    /* Список ваших тестовых постов */
];

let currentPage = 1;
const postsPerPage = 5;

// Рендерит посты на странице
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

// Эмулируем загрузку постов с задержкой
async function fetchMorePosts() {
    return new Promise(resolve => {
        setTimeout(() => {
            resolve(posts.slice(currentPage * postsPerPage, (currentPage + 1) * postsPerPage));
        }, 1000);
    });
}

// Обработчик события scroll для бесконечного скролла
let isLoading = false;
document.addEventListener('scroll', async () => {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && !isLoading) {
        isLoading = true;
        showLoader(); // Показываем лоадер
        
        try {
            const morePosts = await fetchMorePosts();
            if (morePosts.length > 0) {
                renderPosts(morePosts);
                currentPage++; // Переходим на следующую страницу
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

// Показываем начальную выборку постов при открытии страницы
renderPosts(posts.slice(0, postsPerPage)); // Начальная загрузка первых пяти постов
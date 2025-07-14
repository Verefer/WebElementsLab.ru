let currentPage = 1;
const postsPerPage = 5;

// Функция загрузки новой порции постов
async function loadMorePosts() {
    const newPostsContainer = document.createElement('div');
    for(let i=0; i<postsPerPage; i++) {
        let postNumber = currentPage * postsPerPage + i + 1;
        let postDiv = `<div class="post"><p>Пост №${postNumber}</p></div>`;
        newPostsContainer.innerHTML += postDiv;
    }
    document.getElementById('content').appendChild(newPostsContainer);
    currentPage++;
}

// Добавляем обработчик события для отслеживания конца страницы
window.addEventListener("scroll", () => {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        loadMorePosts();
    }
});

// Обработчик кликов по пунктам меню
document.querySelectorAll('#sidebar-menu a').forEach(link => {
    link.addEventListener('click', e => {
        // Удаляем класс active у всех ссылок
        document.querySelectorAll('#sidebar-menu a').forEach(a => a.classList.remove('active'));
        // Добавляем класс active выбранной ссылке
        e.target.classList.add('active');
        
        // Здесь можно добавить логику фильтрации по тегам или категориям
        console.log(`Выбран тег ${e.target.dataset.tag}`);
    });
});
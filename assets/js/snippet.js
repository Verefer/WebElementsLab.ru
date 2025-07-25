// Вкладки
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

// Копировать
document.querySelectorAll('.copy-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const codeBlock = btn.closest('.tab-content').querySelector('code');
    const text = codeBlock.textContent;

    navigator.clipboard.writeText(text).then(() => {
      btn.textContent = '✓ Скопировано';
      setTimeout(() => btn.textContent = '📋 Копировать', 1500);
    });
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const favBtn = document.getElementById('fav-btn');
  if (favBtn) {
    favBtn.addEventListener('click', function() {
      favBtn.classList.toggle('fav');
      if (favBtn.classList.contains('fav')) {
        favBtn.textContent = '💖 В избранном';
      } else {
        favBtn.textContent = '🤍 В избранное';
      }
    });
  }
});

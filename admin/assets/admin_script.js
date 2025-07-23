document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("modal");
  const openBtn = document.getElementById("openModalBtn");
  const closeBtn = modal?.querySelector(".close");

  // Открытие модального окна
  if (openBtn) {
    openBtn.addEventListener("click", (e) => {
      e.preventDefault();
      openModal();
    });
  }

  // Закрытие по клику вне содержимого
  modal?.addEventListener("click", (e) => {
    if (e.target === modal) {
      closeModal();
    }
  });

  // Закрытие по кнопке
  closeBtn?.addEventListener("click", closeModal);

  // Если режим редактирования
  if (typeof isEditMode !== "undefined" && isEditMode) {
    openModal();
  }

  function openModal() {
    modal.classList.add("modal-active");
    document.body.classList.add("modal-open");
    modal.setAttribute("role", "dialog");
    modal.setAttribute("aria-modal", "true");
    modal.setAttribute("aria-labelledby", "openModalBtn");
  }

  function closeModal() {
    modal.classList.remove("modal-active");
    document.body.classList.remove("modal-open");
    modal.removeAttribute("role");
    modal.removeAttribute("aria-modal");
    modal.removeAttribute("aria-labelledby");
  }

  // Валидация формы новостей
  const form = document.querySelector('.form');
  if (form) {
    form.addEventListener('submit', (e) => {
      let isValid = true;

      const title = form.querySelector('input[name="title"]');
      const content = form.querySelector('textarea[name="content"]');
      const image = form.querySelector('input[name="image"]');

      // Удаляем старые ошибки
      form.querySelectorAll('.error-msg').forEach(el => el.remove());
      form.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));

      // Заголовок
      if (!title.value.trim()) {
        showError(title, 'Заполните заголовок');
        isValid = false;
      }

      // Контент
      if (!content.value.trim()) {
        showError(content, 'Заполните содержимое новости');
        isValid = false;
      }

      // Картинка (только если поле видно и есть required)
      if (image && image.required && image.offsetParent !== null && !image.files.length) {
        showError(image, 'Загрузите изображение');
        isValid = false;
      }

      if (!isValid) e.preventDefault();
    });
  }

  function showError(input, message) {
    input.classList.add('input-error');
    const error = document.createElement('div');
    error.className = 'error-msg';
    error.style.color = 'red';
    error.style.fontSize = '0.9rem';
    error.style.marginTop = '5px';
    error.textContent = message;
    input.parentElement.appendChild(error);
  }
});

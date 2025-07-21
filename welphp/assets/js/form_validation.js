function validateForm() {
  const form = document.forms["registrationForm"];

  const fields = {
    name: form["name"],
    password: form["password"],
    confirmPassword: form["confirmPassword"],
    email: form["email"]
  };

  const errors = {
    name: "Введите имя",
    password: "Пароль должен содержать минимум 5 символов",
    confirmPassword: "Пароли не совпадают",
    email: "Введите корректный email",
    agree: "Необходимо согласиться с политикой конфиденциальности"
  };

  let isValid = true;

  // Очистка предыдущих ошибок
  Object.keys(fields).forEach(key => {
    fields[key].classList.remove("input-error");
    const errorDiv = document.getElementById(`${key}-error`);
    if (errorDiv) errorDiv.textContent = "";
  });

  // Отдельно для чекбокса
  const agree = form["agree"];
  agree.classList.remove("input-error");
  const agreeErrorDiv = document.getElementById("agree-error");
  if (agreeErrorDiv) agreeErrorDiv.textContent = "";

  // Валидации
  if (fields.name.value.trim() === "") {
    setError("name", errors.name);
  }

  if (fields.password.value.length < 5) {
    setError("password", errors.password);
  }

  if (fields.password.value !== fields.confirmPassword.value) {
    setError("confirmPassword", errors.confirmPassword);
  }

  if (!fields.email.value.includes("@")) {
    setError("email", errors.email);
  }

  if (!agree.checked) {
    setError("agree", errors.agree);
  }

  function setError(fieldKey, message) {
    const field = fieldKey === "agree" ? form["agree"] : fields[fieldKey];
    field.classList.add("input-error");

    const errorDiv = document.getElementById(`${fieldKey}-error`);
    if (errorDiv) errorDiv.textContent = message;

    if (isValid) field.focus();
    isValid = false;
  }

  return isValid;
}

function validateLogin() {
  const form = document.forms["loginForm"];

  const fields = {
    email: form["email"],
    password: form["password"]
  };

  const errors = {
    email: "Введите корректный email",
    password: "Пароль должен содержать минимум 5 символов"
  };

  let isValid = true;

  // Очистка предыдущих ошибок
  Object.keys(fields).forEach(key => {
    fields[key].classList.remove("input-error");
    const errorDiv = document.getElementById(`${key}-error`);
    if (errorDiv) errorDiv.textContent = "";
  });

  // Валидация email
  if (!fields.email.value.includes("@")) {
    setError("email");
  }

  // Валидация пароля
  if (fields.password.value.length < 5) {
    setError("password");
  }

  function setError(fieldKey) {
    const field = fields[fieldKey];
    field.classList.add("input-error");
    const errorDiv = document.getElementById(`${fieldKey}-error`);
    if (errorDiv) errorDiv.textContent = errors[fieldKey];
    if (isValid) field.focus();
    isValid = false;
  }

  return isValid;
}

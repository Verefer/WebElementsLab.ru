document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const agree = document.getElementById("agree-privacy");

    const emailError = document.getElementById("email-error");
    const usernameError = document.getElementById("username-error");
    const passwordError = document.getElementById("password-error");
    const generalError = document.getElementById("general-error");

    // Валидация имени
    username.addEventListener("blur", () => {
        const name = username.value.trim();
        username.classList.remove("valid", "invalid");
        usernameError.textContent = "";

        const usernameRegex = /^[a-zа-я0-9]{3,20}$/i;

        if (!usernameRegex.test(name)) {
            username.classList.add("invalid");
            usernameError.textContent = "Имя должно быть от 3 до 20 символов, без спецсимволов";
            return;
        }

        checkField("username", name, username);
    });

    // Валидация email
    email.addEventListener("blur", () => {
        const val = email.value.trim();
        email.classList.remove("valid", "invalid");
        emailError.textContent = "";

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(val)) {
            email.classList.add("invalid");
            emailError.textContent = "Некорректный email адрес";
            return;
        }

        checkField("email", val, email);
    });

    // Валидация пароля
    password.addEventListener("blur", () => {
        const val = password.value;
        password.classList.remove("valid", "invalid");
        passwordError.textContent = "";

        const passRegex = /^[A-Za-z0-9!@#$%^&*()_+=\-{}\[\]:;"'<>,.?/~`]{6,}$/;

        if (!passRegex.test(val)) {
            password.classList.add("invalid");
            passwordError.textContent = "Пароль должен быть от 6 символов и содержать буквы, цифры, спецсимволы";
        } else {
            password.classList.add("valid");
        }
    });

    // Проверка формы перед отправкой
    form.addEventListener("submit", (e) => {
        if (!agree.checked) {
            e.preventDefault();
            generalError.textContent = "Необходимо согласиться с политикой конфиденциальности";
        }
    });

    function checkField(field, value, element) {
        fetch(`/check_field.php?field=${field}&value=${encodeURIComponent(value)}`)
            .then(res => res.json())
            .then(data => {
                element.classList.remove('valid', 'invalid');

                if (field === 'email') {
                    if (data.exists) {
                        element.classList.add('invalid');
                        emailError.textContent = 'Указанный электронный адрес уже зарегистрирован';
                    } else {
                        element.classList.add('valid');
                        emailError.textContent = '';
                    }
                }

                if (field === 'username') {
                    if (data.exists) {
                        element.classList.add('invalid');
                        usernameError.textContent = 'Имя пользователя уже занято';
                    } else {
                        element.classList.add('valid');
                        usernameError.textContent = '';
                    }
                }
            });
    }
});

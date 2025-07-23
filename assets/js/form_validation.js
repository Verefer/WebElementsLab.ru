document.addEventListener("DOMContentLoaded", () => {
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const emailError = document.getElementById('email-error');
    const usernameError = document.getElementById('username-error');

    username.addEventListener("blur", () => checkField("username", username.value, username));
    email.addEventListener("blur", () => checkField("email", email.value, email));

    function checkField(field, value, element) {
        if (!value.trim()) return;

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

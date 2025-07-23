document.addEventListener("DOMContentLoaded", () => {
    const username = document.getElementById("username");
    const email = document.getElementById("email");

    username.addEventListener("blur", () => checkField("username", username.value, username));
    email.addEventListener("blur", () => checkField("email", email.value, email));
});

function checkField(field, value, element) {
    if (!value.trim()) return;

    fetch(`/check_field.php?field=${field}&value=${encodeURIComponent(value)}`)
        .then(res => res.json())
        .then(data => {
            if (data.exists) {
                element.classList.add("input-error");
                element.classList.remove("input-success");
            } else {
                element.classList.remove("input-error");
                element.classList.add("input-success");
            }
        });
}
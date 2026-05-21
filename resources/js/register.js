const studentButton = document.getElementById("login-button-student");
const companyButton = document.getElementById("register-button-company");
const universityButton = document.getElementById("register-button-univ");

const togglePassword = document.getElementById("toggle-password");
const passwordInput = document.getElementById("password");

/*
|--------------------------------------------------------------------------
| Переходы
|--------------------------------------------------------------------------
*/

if (studentButton) {
    studentButton.onclick = function () {
        const url = this.getAttribute("data-url");

        window.location.href = url;
    };
}

if (companyButton) {
    companyButton.onclick = function () {
        const url = this.getAttribute("data-url");

        window.location.href = url;
    };
}

if (universityButton) {
    universityButton.onclick = function () {
        const url = this.getAttribute("data-url");

        window.location.href = url;
    };
}

/*
|--------------------------------------------------------------------------
| Показ / скрытие пароля
|--------------------------------------------------------------------------
*/

if (togglePassword && passwordInput) {
    togglePassword.addEventListener("click", function () {
        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";

        passwordInput.setAttribute("type", type);
    });
}

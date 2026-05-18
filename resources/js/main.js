const registerButton = document.getElementById("register-button");
const loginButton = document.getElementById("login-button");
const studLoginButton = document.getElementById("student-login-button");
const compLoginButton = document.getElementById("company-register-button");

registerButton.onclick = function () {
    const url = this.getAttribute("data-url");
    window.location.href = url;
};

loginButton.onclick = function () {
    const url = this.getAttribute("data-url");
    window.location.href = url;
};

studLoginButton.onclick = function () {
    const url = this.getAttribute("data-url");
    window.location.href = url;
};

compLoginButton.onclick = function () {
    const url = this.getAttribute("data-url");
    window.location.href = url;
};

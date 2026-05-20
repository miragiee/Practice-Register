const studentButton = document.getElementById("login-button-student");
const companyButton = document.getElementById("register-button-company");
const universityButton = document.getElementById("register-button-univ");
const regSubmitButton = document.getElementById("register-submit");

studentButton.onclick = function () {
    const url = this.getAttribute("data-url");
    window.location.href = url;
};

companyButton.onclick = function () {
    const url = this.getAttribute("data-url");
    window.location.href = url;
};

universityButton.onclick = function () {
    const url = this.getAttribute("data-url");
    window.location.href = url;
};

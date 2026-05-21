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

const hiwTabs = document.querySelectorAll(".hiw-tab");

const hiwContent = {
    student: [
        {
            title: "Найди место",
            text: "Выбирай из сотен предложений от ведущих компаний страны по твоему профилю."
        },
        {
            title: "Подай заявку",
            text: "Загрузи резюме, пройди отбор и получи подтверждение прямо в приложении."
        },
        {
            title: "Начни практику",
            text: "Получай задачи, общайся с ментором и закрывай практику официально через вуз."
        }
    ],

    university: [
        {
            title: "Добавь студентов",
            text: "Загружай списки студентов и распределяй их по направлениям практики."
        },
        {
            title: "Контролируй процесс",
            text: "Следи за заявками, согласовывай документы и отслеживай прогресс."
        },
        {
            title: "Закрывай практику",
            text: "Подписывай отчёты и автоматически формируй итоговую документацию."
        }
    ],

    company: [
        {
            title: "Создай вакансию",
            text: "Размещай предложения практики и находи подходящих кандидатов."
        },
        {
            title: "Отбирай студентов",
            text: "Просматривай резюме, приглашай на интервью и утверждай стажёров."
        },
        {
            title: "Работай с практикантами",
            text: "Назначай менторов, выдавай задачи и оценивай результаты работы."
        }
    ]
};

hiwTabs.forEach(tab => {
    tab.addEventListener("click", () => {

        hiwTabs.forEach(btn => btn.classList.remove("active"));
        tab.classList.add("active");

        const role = tab.dataset.role;
        const content = hiwContent[role];

        content.forEach((item, index) => {
            document.getElementById(`card-title-${index + 1}`).textContent = item.title;
            document.getElementById(`card-text-${index + 1}`).textContent = item.text;
        });
    });
});

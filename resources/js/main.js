const loginButton = document.getElementById("login-button");
const registerButton = document.getElementById("register-button");

const studentLoginButton = document.getElementById("student-login-button");
const companyRegisterButton = document.getElementById(
    "company-register-button",
);

loginButton.addEventListener("click", () => {
    window.location.href = loginButton.dataset.url;
});

registerButton.addEventListener("click", () => {
    window.location.href = registerButton.dataset.url;
});

studentLoginButton.addEventListener("click", () => {
    window.location.href = studentLoginButton.dataset.url;
});

companyRegisterButton.addEventListener("click", () => {
    window.location.href = companyRegisterButton.dataset.url;
});

const hiwTabs = document.querySelectorAll(".hiw-tab");

const hiwContent = {
    student: [
        {
            title: "Найди место",
            text: "Выбирай из сотен предложений от ведущих компаний страны по твоему профилю.",
        },
        {
            title: "Подай заявку",
            text: "Загрузи резюме, пройди отбор и получи подтверждение прямо в приложении.",
        },
        {
            title: "Начни практику",
            text: "Получай задачи, общайся с ментором и закрывай практику официально через вуз.",
        },
    ],

    university: [
        {
            title: "Добавь студентов",
            text: "Загружай списки студентов и управляй распределением практик централизованно.",
        },
        {
            title: "Контролируй процесс",
            text: "Следи за прохождением практики и подписывай документы онлайн.",
        },
        {
            title: "Получай отчеты",
            text: "Автоматически формируй отчеты и статистику по практикам.",
        },
    ],

    company: [
        {
            title: "Размести вакансию",
            text: "Публикуй предложения практик и стажировок для студентов.",
        },
        {
            title: "Найди кандидатов",
            text: "Получай отклики и отбирай лучших студентов по навыкам и успеваемости.",
        },
        {
            title: "Найми лучших",
            text: "Формируй кадровый резерв и нанимай перспективных специалистов.",
        },
    ],
};

function updateCards(role) {
    const content = hiwContent[role];

    content.forEach((item, index) => {
        document.getElementById(`card-title-${index + 1}`).textContent =
            item.title;

        document.getElementById(`card-text-${index + 1}`).textContent =
            item.text;
    });
}

hiwTabs.forEach((tab) => {
    tab.addEventListener("click", () => {
        hiwTabs.forEach((btn) => btn.classList.remove("active"));

        tab.classList.add("active");

        const role = tab.dataset.role;

        updateCards(role);
    });
});

const howItWorksSection = document.querySelector(".how-it-works");

const navLinks = {
    "for-students": "student",
    "for-companies": "company",
    "for-universities": "university",
};

Object.entries(navLinks).forEach(([linkId, role]) => {
    const navLink = document.getElementById(linkId);

    navLink.addEventListener("click", (e) => {
        e.preventDefault();

        // скролл к блоку
        howItWorksSection.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });

        // активация нужного tab
        const targetTab = document.querySelector(
            `.hiw-tab[data-role="${role}"]`,
        );

        targetTab.click();
    });
});

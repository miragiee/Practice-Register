document.addEventListener("DOMContentLoaded", () => {
    const roleButtons = document.querySelectorAll(".role-switcher button");

    const roleIcon = document.querySelector(".login-role svg");
    const roleText = document.querySelector(".login-role span");

    const emailInput = document.querySelector('input[type="email"]');

    const formTitle = document.querySelector(".auth-header h1");

    const submitButton = document.querySelector(".submit-btn");

    const authForm = document.getElementById("auth-form");
    const roleInput = document.getElementById("role-input");

    const roleRoutes = {
        student: "/auth/student",
        university: "/auth/university",
        company: "/auth/company",
    };

    const roles = {
        student: {
            text: "Войти как студент",
            placeholder: "example@student.edu",
            title: "Войти в платформу",
            button: "Войти",

            icon: `
                <path d="M12 3L1 9L12 15L21 10.09V17H23V9L12 3ZM5 12.18V16.18L12 20L19 16.18V12.18L12 16L5 12.18Z"
                      fill="currentColor"/>
            `,
        },

        university: {
            text: "Войти как университет",
            placeholder: "example@university.edu",
            title: "Войти в платформу",
            button: "Войти",

            icon: `
                <path d="M12 3L1 9L12 15L21 9L12 3ZM3 11V13H5V18H19V13H21V11H3ZM7 13H9V16H7V13ZM11 13H13V16H11V13ZM15 13H17V16H15V13Z"
                      fill="currentColor"/>
            `,
        },

        company: {
            text: "Войти как компания",
            placeholder: "hr@company.com",
            title: "Войти в платформу",
            button: "Войти",

            icon: `
                <path d="M4 21H20V8H4V21ZM9 3H15V6H19C20.1 6 21 6.9 21 8V21C21 22.1 20.1 23 19 23H5C3.9 23 3 22.1 3 21V8C3 6.9 3.9 6 5 6H9V3ZM11 5V6H13V5H11Z"
                      fill="currentColor"/>
            `,
        },
    };

    function setRole(roleKey, activeButton) {
        roleButtons.forEach((button) => {
            button.classList.remove("active");
        });

        activeButton.classList.add("active");

        const role = roles[roleKey];

        roleText.textContent = role.text;

        emailInput.placeholder = role.placeholder;

        formTitle.textContent = role.title;

        submitButton.textContent = role.button;

        roleIcon.innerHTML = role.icon;

        // Update form action and hidden role input
        if (authForm)
            authForm.action = roleRoutes[roleKey] || roleRoutes.student;
        if (roleInput) roleInput.value = roleKey;

        animateForm();
    }

    function animateForm() {
        const animatedElements = [
            roleText,
            emailInput,
            formTitle,
            submitButton,
            roleIcon,
        ];

        animatedElements.forEach((element) => {
            element.style.opacity = "0";
            element.style.transform = "translateY(10px)";

            setTimeout(() => {
                element.style.transition =
                    "opacity 0.25s ease, transform 0.25s ease";

                element.style.opacity = "1";
                element.style.transform = "translateY(0)";
            }, 50);
        });
    }

    roleButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const roleText = button.textContent.trim();

            if (roleText === "Студент") {
                setRole("student", button);
            }

            if (roleText === "Университет") {
                setRole("university", button);
            }

            if (roleText === "Компания") {
                setRole("company", button);
            }
        });
    });
});

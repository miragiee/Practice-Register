document.addEventListener("DOMContentLoaded", () => {
    // Переключение вкладок
    const navItems = document.querySelectorAll(".nav-item");

    const views = {
        partners: document.getElementById("view-partners"),
        students: document.getElementById("view-students"),
    };

    function show(viewName) {
        Object.entries(views).forEach(([key, el]) => {
            if (!el) return;
            el.style.display = key === viewName ? "" : "none";
        });
    }

    navItems.forEach((item) => {
        item.addEventListener("click", (e) => {
            const view = item.dataset.view;
            // Если это не вкладка (например, кнопка «В профиль»), не мешаем переходу
            if (!view || !views[view]) {
                // Не вызываем preventDefault, ссылка сработает как обычная
                return;
            }

            e.preventDefault();

            navItems.forEach((i) => i.classList.remove("active"));
            item.classList.add("active");

            show(view);
        });
    });

    // Hover-эффекты для строк таблицы студентов
    const table = document.querySelector(".students-table");
    if (table) {
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach((row) => {
            row.addEventListener("mouseenter", () => {
                row.style.backgroundColor = "#fafbff";
            });
            row.addEventListener("mouseleave", () => {
                row.style.backgroundColor = "#fff";
            });
        });

        // Кнопки "⋮"
        const moreButtons = table.querySelectorAll(".student-more");
        moreButtons.forEach((button) => {
            button.addEventListener("click", () => {
                console.log("Открыть действия студента");
            });
        });

        // --- Фильтрация и поиск ---
        const searchInput = document.getElementById("student-search-input");
        const specialitySelect = document.getElementById("speciality-filter");
        const courseSelect = document.getElementById("course-filter");
        const resetButton = document.getElementById("reset-button");
        const filterButton = document.getElementById("filter-button");

        // Заполнение выпадающего списка специальностей
        const specialities = new Set();
        table.querySelectorAll(".student-speciality").forEach(td => {
            const text = td.textContent.trim();
            if (text && text !== '—') specialities.add(text);
        });
        specialities.forEach(spec => {
            const option = document.createElement("option");
            option.value = spec;
            option.textContent = spec;
            specialitySelect.appendChild(option);
        });

        // Заполнение выпадающего списка курсов
        const courses = new Set();
        table.querySelectorAll(".student-badge").forEach(badge => {
            const courseText = badge.textContent.trim();
            const courseNumber = courseText.match(/\d+/);
            if (courseNumber) courses.add(courseNumber[0]);
        });
        Array.from(courses)
            .sort((a, b) => a - b)
            .forEach(course => {
                const option = document.createElement("option");
                option.value = course;
                option.textContent = `${course} курс`;
                courseSelect.appendChild(option);
            });

        // Функция фильтрации строк
        function filterRows() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedSpeciality = specialitySelect.value;
            const selectedCourse = courseSelect.value;

            const rows = table.querySelectorAll("tbody tr:not(.table-footer-row)");
            rows.forEach(row => {
                if (row.querySelector(".student-list__empty")) return;

                const name = row.querySelector("h4")?.textContent.toLowerCase() || "";
                const studentId = row.querySelector("p")?.textContent.replace(/ID:\s*/, "").trim() || "";
                const speciality = row.querySelector(".student-speciality")?.textContent.trim() || "";
                const courseBadge = row.querySelector(".student-badge")?.textContent.trim() || "";
                const courseMatch = courseBadge.match(/\d+/);
                const course = courseMatch ? courseMatch[0] : "";

                const matchesSearch = (
                    searchTerm === "" ||
                    name.includes(searchTerm) ||
                    studentId.includes(searchTerm)
                );
                const matchesSpeciality = (
                    selectedSpeciality === "" ||
                    speciality === selectedSpeciality
                );
                const matchesCourse = (
                    selectedCourse === "" ||
                    course === selectedCourse
                );

                row.style.display = (matchesSearch && matchesSpeciality && matchesCourse) ? "" : "none";
            });
        }

        if (searchInput) {
            searchInput.addEventListener("input", filterRows);
        }
        if (specialitySelect) {
            specialitySelect.addEventListener("change", filterRows);
        }
        if (courseSelect) {
            courseSelect.addEventListener("change", filterRows);
        }

        if (resetButton) {
            resetButton.addEventListener("click", () => {
                if (searchInput) searchInput.value = "";
                if (specialitySelect) specialitySelect.value = "";
                if (courseSelect) courseSelect.value = "";
                filterRows();
            });
        }

        if (filterButton) {
            filterButton.addEventListener("click", () => {
                console.log("Открыть расширенные фильтры (пока не реализовано)");
            });
        }
    }

    // Инициализация: показываем вкладку "Партнёры"
    show("partners");
});
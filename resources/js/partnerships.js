document.addEventListener("DOMContentLoaded", () => {
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
            e.preventDefault();

            const view = item.dataset.view;
            if (!view || !views[view]) return;

            navItems.forEach((i) => i.classList.remove("active"));
            item.classList.add("active");

            show(view);
        });
    });

    const rows = document.querySelectorAll(".students-table tbody tr");

    rows.forEach((row) => {
        row.addEventListener("mouseenter", () => {
            row.style.backgroundColor = "#fafbff";
        });

        row.addEventListener("mouseleave", () => {
            row.style.backgroundColor = "#fff";
        });
    });

    const moreButtons = document.querySelectorAll(".student-more");

    moreButtons.forEach((button) => {
        button.addEventListener("click", () => {
            console.log("Открыть действия студента");
        });
    });

    // init state
    show("partners");
});

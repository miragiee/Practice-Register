document.addEventListener("DOMContentLoaded", () => {
    const navItems = document.querySelectorAll(".nav-item");

    navItems.forEach((item) => {
        item.addEventListener("click", () => {
            navItems.forEach((el) => {
                el.classList.remove("active");
            });

            item.classList.add("active");
        });
    });

    const paginationButtons = document.querySelectorAll(".pagination button");

    paginationButtons.forEach((button) => {
        button.addEventListener("click", () => {
            paginationButtons.forEach((btn) => {
                btn.classList.remove("active");
            });

            if (button.textContent !== "‹" && button.textContent !== "›") {
                button.classList.add("active");
            }
        });
    });
});

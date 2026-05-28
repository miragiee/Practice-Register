const vacancy_btn = document.getElementById("add-vacancy-btn");
const partnershipsBtn = document.querySelector(".partnerships-btn");

if (vacancy_btn) {
    vacancy_btn.onclick = function () {
        const url = this.getAttribute("data-url");

        if (url) {
            window.location.href = url;
        }
    };
}

if (partnershipsBtn) {

    partnershipsBtn.addEventListener("click", function () {

        const url = this.getAttribute("data-url");

        if (url) {
            window.location.href = url;
        }

    });

}

window.addEventListener("scroll", () => {
    const header = document.querySelector(".header");

    if (!header) return;

    if (window.scrollY > 10) {
        header.style.boxShadow = "0 2px 20px rgba(0,0,0,0.15)";
    } else {
        header.style.boxShadow = "none";
    }
});

function toggleBookmark(el) {
    el.classList.toggle("bookmarked");

    const svg = el.querySelector("svg");

    if (!svg) return;

    if (el.classList.contains("bookmarked")) {
        svg.setAttribute("fill", "#E65100");

        el.style.transform = "scale(1.3)";

        setTimeout(() => {
            el.style.transform = "scale(1)";
        }, 200);
    } else {
        svg.setAttribute("fill", "none");
    }
}

function animateCounters() {
    document.querySelectorAll(".stat-value[data-target]").forEach((counter) => {
        const target = parseInt(counter.getAttribute("data-target"));

        if (isNaN(target)) return;

        const duration = 1500;
        const startTime = performance.now();

        const suffix = counter.textContent.includes("+") ? "+" : "";

        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;

            const progress = Math.min(elapsed / duration, 1);

            const eased = 1 - Math.pow(1 - progress, 3);

            const current = Math.floor(eased * target);

            counter.textContent = current + suffix;

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            }
        }

        requestAnimationFrame(updateCounter);
    });
}

setTimeout(animateCounters, 300);

document.querySelectorAll(".add-vacancy-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        this.style.transform = "scale(0.95)";

        setTimeout(() => {
            this.style.transform = "";
        }, 150);
    });
});

document.querySelectorAll(".gallery-item").forEach((item) => {
    item.addEventListener("click", function () {
        this.style.transform = "scale(0.95)";

        setTimeout(() => {
            this.style.transform = "";
        }, 200);
    });
});

document.querySelectorAll(".cancel-reservation-btn").forEach((button) => {
    button.addEventListener("click", async function () {
        const action = this.getAttribute("data-action");

        if (!action) return;

        if (!confirm("Вы уверены, что хотите отменить бронирование?")) {
            return;
        }

        try {
            const response = await fetch(action, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || "",
                    "Accept": "application/json",
                },
            });

            if (!response.ok) {
                throw new Error("Failed to cancel reservation");
            }

            window.location.reload();
        } catch (error) {
            console.error(error);
            alert("Не удалось отменить бронирование");
        }
    });
});

document.querySelectorAll(".vacancy-card").forEach((card) => {
    card.addEventListener("click", function (e) {
        if (
            e.target.closest(".vacancy-bookmark") ||
            e.target.closest(".vacancy-detail-link")
        ) {
            return;
        }

        this.style.transform = "translateY(-2px) scale(0.98)";

        setTimeout(() => {
            this.style.transform = "";
        }, 200);
    });
});

const statsCard = document.querySelector(".stats-card");

if (statsCard) {
    statsCard.addEventListener("mousemove", (e) => {
        const rect = statsCard.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = (y - centerY) / 15;
        const rotateY = (centerX - x) / 15;

        statsCard.style.transform = `perspective(1000px)
            rotateX(${rotateX}deg)
            rotateY(${rotateY}deg)
            translateY(-3px)`;
    });

    statsCard.addEventListener("mouseleave", () => {
        statsCard.style.transform = "";
    });
}

document.querySelectorAll(".fade-in").forEach((el) => {
    el.style.animationPlayState = "running";
});

document.querySelectorAll(".header-nav a, .footer-col a").forEach((link) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
    });
});

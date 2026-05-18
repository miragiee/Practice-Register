window.addEventListener("scroll", () => {
    const header = document.querySelector(".header");
    if (window.scrollY > 10) {
        header.style.boxShadow = "0 2px 20px rgba(0,0,0,0.15)";
    } else {
        header.style.boxShadow = "none";
    }
});

function toggleBookmark(el) {
    el.classList.toggle("bookmarked");
    const svg = el.querySelector("svg");
    if (el.classList.contains("bookmarked")) {
        svg.setAttribute("fill", "#E65100");
        // Add pop animation
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

document
    .querySelector(".add-vacancy-btn")
    .addEventListener("click", function () {
        this.style.transform = "scale(0.95)";
        setTimeout(() => {
            this.style.transform = "";
        }, 150);
    });

document.querySelectorAll(".gallery-item").forEach((item) => {
    item.addEventListener("click", function () {
        this.style.transform = "scale(0.95)";
        setTimeout(() => {
            this.style.transform = "";
        }, 200);
    });
});

document.querySelectorAll(".vacancy-card").forEach((card) => {
    card.addEventListener("click", function (e) {
        if (
            e.target.closest(".vacancy-bookmark") ||
            e.target.closest(".vacancy-detail-link")
        )
            return;

        this.style.transform = "translateY(-2px) scale(0.98)";
        setTimeout(() => {
            this.style.transform = "";
        }, 200);
    });
});

const statsCard = document.querySelector(".stats-card");
statsCard.addEventListener("mousemove", (e) => {
    const rect = statsCard.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    const rotateX = (y - centerY) / 15;
    const rotateY = (centerX - x) / 15;

    statsCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-3px)`;
});

statsCard.addEventListener("mouseleave", () => {
    statsCard.style.transform = "";
});

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = "running";
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.1 },
);

document.querySelectorAll(".fade-in").forEach((el) => {
    el.style.animationPlayState = "running";
});

document.querySelectorAll(".advantage-card").forEach((card) => {
    card.addEventListener("mouseenter", function () {
        const icon = this.querySelector(".advantage-icon svg");
        icon.style.color = "#fff";
        this.querySelector(".advantage-icon").style.background = "#4A6CF7";
    });
    card.addEventListener("mouseleave", function () {
        const icon = this.querySelector(".advantage-icon svg");
        icon.style.color = "#4A6CF7";
        this.querySelector(".advantage-icon").style.background = "#f0f4ff";
    });
});

document
    .querySelectorAll(".header-nav a, .footer-col a, .vacancy-detail-link")
    .forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
        });
    });

document.querySelectorAll(".header-nav a, .footer-col a").forEach((link) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
    });
});

const editBtn = document.querySelector(".edit-btn");
editBtn.addEventListener("click", function () {
    this.style.transform = "scale(0.95)";
    setTimeout(() => {
        this.style.transform = "";
    }, 150);
});

document.querySelectorAll(".menu-item").forEach((item) => {
    item.addEventListener("click", function () {
        document
            .querySelectorAll(".menu-item")
            .forEach((i) => i.classList.remove("active"));
        this.classList.add("active");
    });
});

document.querySelectorAll(".doc-item").forEach((doc) => {
    doc.addEventListener("click", function () {
        this.style.transform = "scale(0.98)";
        setTimeout(() => {
            this.style.transform = "";
        }, 150);
    });
});

const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = "running";
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll(".fade-in").forEach((el) => {
    el.style.animationPlayState = "running";
    // observer.observe(el); // Uncomment if you want scroll-triggered animations
});

const profileCard = document.querySelector(".profile-card");
profileCard.addEventListener("mousemove", (e) => {
    const rect = profileCard.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    const rotateX = (y - centerY) / 20;
    const rotateY = (centerX - x) / 20;

    profileCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-2px)`;
});

profileCard.addEventListener("mouseleave", () => {
    profileCard.style.transform = "";
});

const skillColors = [
    { bg: "#e8eeff", color: "#4A6CF7" },
    { bg: "#fff3e0", color: "#E65100" },
    { bg: "#e8f5e9", color: "#2E7D32" },
    { bg: "#f3e5f5", color: "#7B1FA2" },
    { bg: "#e0f2f1", color: "#00695C" },
    { bg: "#fce4ec", color: "#C62828" },
    { bg: "#e3f2fd", color: "#1565C0" },
    { bg: "#fff8e1", color: "#F57F17" },
];

document.querySelectorAll(".skill-tag").forEach((tag) => {
    tag.addEventListener("mouseenter", function () {
        const randomColor =
            skillColors[Math.floor(Math.random() * skillColors.length)];
        this.style.background = randomColor.bg;
        this.style.color = randomColor.color;
    });

    tag.addEventListener("mouseleave", function () {
        this.style.background = "";
        this.style.color = "";
    });
});

window.addEventListener("scroll", () => {
    const header = document.querySelector(".header");
    if (window.scrollY > 10) {
        header.style.boxShadow = "0 2px 20px rgba(0,0,0,0.15)";
    } else {
        header.style.boxShadow = "none";
    }
});

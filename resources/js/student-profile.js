document.querySelectorAll(".header-nav a, .footer-col a").forEach((link) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
    });
});

const editBtn = document.querySelector(".edit-btn");
const editModal = document.getElementById("edit-profile-modal");
const closeEditBtn = document.querySelector(".close-edit-btn");
const cancelBtn = document.querySelector(".btn-cancel");
const editForm = document.getElementById("edit-profile-form");

// Open edit modal
editBtn.addEventListener("click", function () {
    editModal.classList.add("active");
    document.body.style.overflow = "hidden";
});

// Close edit modal
function closeEditModal() {
    editModal.classList.remove("active");
    document.body.style.overflow = "";
}

closeEditBtn.addEventListener("click", closeEditModal);
cancelBtn.addEventListener("click", closeEditModal);

// Close modal on overlay click
document.querySelector(".edit-profile-overlay").addEventListener("click", closeEditModal);

// Handle form submission
editForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    
    const formData = new FormData(editForm);
    const studentId = document.body.getAttribute('data-student-id');
    
    try {
        const response = await fetch(`/student/${studentId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify({
                full_name: formData.get('full_name'),
                email: formData.get('email'),
                course: formData.get('course'),
                university_id: formData.get('university_id'),
                direction_id: formData.get('direction_id'),
            })
        });

        if (response.ok) {
            closeEditModal();
            // Reload page to see updated data
            window.location.reload();
        } else {
            alert('Ошибка при обновлении профиля');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Ошибка при обновлении профиля');
    }
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

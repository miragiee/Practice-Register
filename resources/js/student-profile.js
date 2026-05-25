document.querySelectorAll(".header-nav a, .footer-col a").forEach((link) => {
    link.addEventListener("click", (e) => e.preventDefault());
});

const editBtn = document.querySelector(".edit-btn");
const editModal = document.getElementById("edit-profile-modal");
const closeEditBtn = document.querySelector(".close-edit-btn");
const cancelBtn = document.querySelector(".btn-cancel");
const editForm = document.getElementById("edit-profile-form");

if (editBtn) {
    editBtn.addEventListener("click", () => {
        editModal.classList.add("active");
        document.body.style.overflow = "hidden";
    });
}

function closeEditModal() {
    editModal.classList.remove("active");
    document.body.style.overflow = "";
}
if (closeEditBtn) closeEditBtn.addEventListener("click", closeEditModal);
if (cancelBtn) cancelBtn.addEventListener("click", closeEditModal);
document.querySelector(".edit-profile-overlay")?.addEventListener("click", closeEditModal);

if (editForm) {
    editForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(editForm);
        const studentId = document.body.getAttribute("data-student-id");

        try {
            const response = await fetch(`/student/${studentId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || "",
                },
                body: JSON.stringify({
                    full_name: formData.get("full_name"),
                    email: formData.get("email"),
                    course: formData.get("course"),
                    university_id: formData.get("university_id"),
                    direction_id: formData.get("direction_id"),
                }),
            });
            if (response.ok) {
                closeEditModal();
                window.location.reload();
            } else {
                alert("Ошибка при обновлении профиля");
            }
        } catch (error) {
            console.error(error);
            alert("Ошибка при обновлении профиля");
        }
    });
}

const contentContainer = document.getElementById("dynamic-content");
let isLoadingReservations = false;

async function loadReservations() {
    if (isLoadingReservations) return;
    isLoadingReservations = true;
    contentContainer.innerHTML = '<div class="loading-spinner">Загрузка откликов...</div>';
    try {
        const response = await fetch('/student/reservations', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        });

        if (!response.ok) {
            contentContainer.innerHTML = '<div class="error-message">Ошибка загрузки откликов</div>';
            return;
        }

        const html = await response.text();
        contentContainer.innerHTML = html;
        attachCancelHandlers();
    } catch (error) {
        console.error(error);
        contentContainer.innerHTML = '<div class="error-message">Ошибка загрузки откликов</div>';
    } finally {
        isLoadingReservations = false;
    }
}

function restoreProfile() {
    const template = document.getElementById('profile-content-template');
    if (!template) return;
    contentContainer.innerHTML = '';
    const freshClone = template.content.cloneNode(true);
    contentContainer.appendChild(freshClone);
    initSkillHoverEffects();
    initProfileCard3DEffect();
}

function attachCancelHandlers() {
    document.querySelectorAll('.btn-cancel-reservation').forEach(btn => {
        btn.removeEventListener('click', cancelReservation);
        btn.addEventListener('click', cancelReservation);
    });
}

async function cancelReservation(e) {
    const btn = e.currentTarget;
    const reservationId = btn.getAttribute('data-id');
    if (!reservationId) return;
    if (!confirm('Вы уверены, что хотите отменить этот отклик?')) return;

    try {
        const response = await fetch(`/reservations/${reservationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'Content-Type': 'application/json'
            }
        });
        if (response.ok) {
            loadReservations();
        } else {
            alert('Не удалось отменить отклик');
        }
    } catch (error) {
        console.error(error);
        alert('Ошибка при отмене');
    }
}

const menuItems = document.querySelectorAll(".menu-item");
menuItems.forEach(item => {
    item.addEventListener("click", function (e) {
        e.preventDefault();
        const tab = this.getAttribute("data-tab");
        menuItems.forEach(i => i.classList.remove("active"));
        this.classList.add("active");

        if (tab === "profile") {
            restoreProfile();
        } else if (tab === "responses") {
            loadReservations();
        }
    });
});

function initSkillHoverEffects() {
    const skillColors = [
        { bg: "#e8eeff", color: "#4A6CF7" }, { bg: "#fff3e0", color: "#E65100" },
        { bg: "#e8f5e9", color: "#2E7D32" }, { bg: "#f3e5f5", color: "#7B1FA2" },
        { bg: "#e0f2f1", color: "#00695C" }, { bg: "#fce4ec", color: "#C62828" },
        { bg: "#e3f2fd", color: "#1565C0" }, { bg: "#fff8e1", color: "#F57F17" },
    ];
    document.querySelectorAll(".skill-tag").forEach(tag => {
        tag.removeEventListener("mouseenter", tag._mouseEnterHandler);
        tag.removeEventListener("mouseleave", tag._mouseLeaveHandler);
        const enterHandler = function () {
            const randomColor = skillColors[Math.floor(Math.random() * skillColors.length)];
            this.style.background = randomColor.bg;
            this.style.color = randomColor.color;
        };
        const leaveHandler = function () {
            this.style.background = "";
            this.style.color = "";
        };
        tag.addEventListener("mouseenter", enterHandler);
        tag.addEventListener("mouseleave", leaveHandler);
        tag._mouseEnterHandler = enterHandler;
        tag._mouseLeaveHandler = leaveHandler;
    });
}

function initProfileCard3DEffect() {
    const profileCard = document.querySelector(".profile-card");
    if (!profileCard) return;
    const handleMove = (e) => {
        const rect = profileCard.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = (y - centerY) / 20;
        const rotateY = (centerX - x) / 20;
        profileCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-2px)`;
    };
    const handleLeave = () => {
        profileCard.style.transform = "";
    };
    profileCard.addEventListener("mousemove", handleMove);
    profileCard.addEventListener("mouseleave", handleLeave);
}

function initFadeInAnimations() {
    document.querySelectorAll(".fade-in").forEach(el => {
        el.style.animationPlayState = "running";
    });
}

window.addEventListener("scroll", () => {
    const header = document.querySelector(".header");
    if (window.scrollY > 10) {
        header.style.boxShadow = "0 2px 20px rgba(0,0,0,0.15)";
    } else {
        header.style.boxShadow = "none";
    }
});

initSkillHoverEffects();
initProfileCard3DEffect();
initFadeInAnimations();
restoreProfile();

document.querySelectorAll(".doc-item").forEach(doc => {
    doc.addEventListener("click", function () {
        this.style.transform = "scale(0.98)";
        setTimeout(() => { this.style.transform = ""; }, 150);
    });
});
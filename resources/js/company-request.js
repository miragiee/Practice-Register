document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".request-card");

    cards.forEach((card, index) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(20px)";

        setTimeout(() => {
            card.style.transition = "0.4s ease";

            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }, index * 120);
    });
    // Ensure detail links work even if some layout/overlay prevents default
    document.querySelectorAll('.details-button, .vacancy-detail-link').forEach(el => {
        el.addEventListener('click', (e) => {
            const href = el.getAttribute('href');
            if (href && !href.startsWith('#')) {
                // allow normal navigation but as a fallback force navigation
                setTimeout(() => { window.location.href = href; }, 10);
            }
        });
    });
});

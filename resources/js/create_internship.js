document.addEventListener('DOMContentLoaded', function () {

    // СВОРAЧИВАНИЕ
    window.toggleCard = function (header) {
        const body = header.nextElementSibling;
        body.classList.toggle('hidden');
    }

    // ПОИСК
    const input = document.getElementById('searchInput');

    if (input) {
        input.addEventListener('input', function () {
            const value = this.value.toLowerCase();

            document.querySelectorAll('.internship-card').forEach(card => {
                const text = card.innerText.toLowerCase();

                card.style.display = text.includes(value) ? '' : 'none';
            });
        });
    }

});

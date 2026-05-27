const partnershipsBtn = document.querySelector('.partnerships-btn');

document.querySelectorAll('.practice-item').forEach(item => {

        item.addEventListener('click', () => {

            item.classList.toggle('active');

        });

    });


if (partnershipsBtn) {

    partnershipsBtn.addEventListener('click', function () {

        const url = this.getAttribute('data-url');

        if (url) {
            window.location.href = url;
        }

    });

}
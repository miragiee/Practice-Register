document.addEventListener('DOMContentLoaded', () => {

    const courseButtons = document.querySelectorAll('.course-buttons button');

    courseButtons.forEach(button => {

        button.addEventListener('click', () => {

            courseButtons.forEach(btn => btn.classList.remove('active'));

            button.classList.add('active');

        });

    });

});

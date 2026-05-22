document.querySelectorAll('.practice-item').forEach(item => {

    item.addEventListener('click', () => {

        item.classList.toggle('active');

    });

});

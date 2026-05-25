document.addEventListener('DOMContentLoaded', () => {

    const searchButton = document.querySelector('.search-box button');

    searchButton.addEventListener('click', () => {

        const searchValue = document.querySelector('#search').value;

        console.log('Поиск:', searchValue);

    });

});

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студенты в поиске</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/students-in-search.js', 'resources/css/students-in-search.css'])
</head>
<body>

<main class="main">

    <div class="container">

        <div class="breadcrumbs">
            Дашборд > <span>Студенты в поиске</span>
        </div>

        <div class="top-section">

            <div class="search-counter">
                <div class="counter-label">Активный поиск</div>
                <div class="counter-value">0 студентов</div>
            </div>

        </div>

        <div class="content-wrapper">

            <!-- Sidebar -->
            <aside class="sidebar">

                <div class="filters-card">

                    <h3>Фильтры</h3>

                    <div class="filter-group">
                        <label>Направление</label>

                        <select id="direction-select" class="filter-select">
                            <option value="">Все направления</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Курс</label>

                        <div class="course-buttons">
                            <button class="active" data-course="">Все</button>
                            <button data-course="3">3 курс</button>
                            <button data-course="4">4 курс</button>
                            <button data-course="m">Магистратура</button>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label>Статус верификации</label>

                        <div class="checkbox-wrapper">
                            <input type="checkbox" checked id="verified">
                            <label for="verified">Только проверенные</label>
                        </div>
                    </div>

                </div>

                <div class="help-card">
                    <h3>Нужна помощь?</h3>

                    <p>
                        Загрузите список вакансий от партнеров,
                        чтобы автоматически сопоставить их со студентами.
                    </p>

                    <button class="import-button">Импорт вакансий</button>
                </div>

            </aside>

            <!-- Students -->
            <section class="students-section">

                <div class="students-grid" aria-live="polite"></div>

                <!-- Pagination -->
                <div class="pagination">

                    <button>&lt;</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>&gt;</button>

                </div>

            </section>

        </div>

    </div>

</main>

<footer>
        <div class="container">
            <div>
            <h3>Практикум</h3>
            <p>© 2024 Практикум. Платформа для развития кадрового потенциала. </p>
        </div>
        <div>
            <div>
                <h3>Платформа</h3>
                <a href="">О платформе</a>
                <a href="">Партнерам</a>
                <a href="">Карьера</a>
            </div>
            <div>
                <h3>Помощь</h3>
                <a href="">Центр помощи</a>
                <a href="">Конфиденциальность</a>
            </div>
            <div>
                <h3>Контакты</h3>
                <p>info@praktikum.edu</p>
                <p>8 (800) 555-35-35</p>
            </div>
        </div>
        </div>
    </footer>



</body>
</html>

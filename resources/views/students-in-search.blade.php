<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студенты в поиске</title>

    @vite(['resources/js/students-in-search.js', 'resources/css/students-in-search.css'])
</head>
<body>

<header class="header">
    <div class="container header-container">

        <div class="logo">
            Практикум
        </div>

        <nav class="nav">
            <a href="#">Студентам</a>
            <a href="#" class="active">Университетам</a>
            <a href="#">Компаниям</a>
            <a href="#">Тарифы</a>
        </nav>

        <div class="profile-link">
            Профиль
        </div>

    </div>
</header>

<main class="main">

    <div class="container">

        <div class="breadcrumbs">
            Дашборд > <span>Студенты в поиске</span>
        </div>

        <div class="top-section">

            <div>
                <h1>Студенты в поиске</h1>

                <p class="description">
                    Мониторинг студентов вашего вуза, активно ищущих места для прохождения практики.
                    Помогайте им находить лучшие предложения от компаний-партнеров.
                </p>
            </div>

            <div class="search-counter">
                <div class="counter-title">Активный поиск</div>
                <div class="counter-number">124 студента</div>
            </div>

        </div>

        <div class="content-wrapper">

            <!-- Sidebar -->
            <aside class="sidebar">

                <div class="filters-card">

                    <h3>Фильтры</h3>

                    <div class="filter-group">
                        <label>Направление</label>

                        <select>
                            <option>Все направления</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Курс</label>

                        <div class="course-buttons">
                            <button class="active">Все</button>
                            <button>3 курс</button>
                            <button>4 курс</button>
                            <button>Магистратура</button>
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

                    <button>Импорт вакансий</button>
                </div>

            </aside>

            <!-- Students -->
            <section class="students-section">

                <div class="students-grid">

                    <!-- Card 1 -->
                    <div class="student-card">

                        <div class="student-header">

                            <div class="student-info">
                                <img src="https://i.pravatar.cc/100?img=12" alt="student">

                                <div>
                                    <h4>Алексей Морозов</h4>

                                    <div class="student-meta">
                                        4 курс, ИТ-факультет
                                    </div>
                                </div>
                            </div>

                            <span class="badge green">TOP 5%</span>

                        </div>

                        <div class="card-label">Желаемая роль</div>

                        <div class="student-role">
                            Backend Developer (Go / Python)
                        </div>

                        <div class="card-label">Навыки</div>

                        <div class="skills">
                            <span>Go</span>
                            <span>PostgreSQL</span>
                            <span>Docker</span>
                            <span>Kubernetes</span>
                        </div>

                        <div class="card-actions">
                            <button class="profile-btn">Профиль</button>
                            <button class="message-btn">✉</button>
                        </div>

                    </div>

                    <!-- Card 2 -->
                    <div class="student-card">

                        <div class="student-header">

                            <div class="student-info">
                                <img src="https://i.pravatar.cc/100?img=32" alt="student">

                                <div>
                                    <h4>Мария Волкова</h4>

                                    <div class="student-meta">
                                        Магистратура, Биотех
                                    </div>
                                </div>
                            </div>

                            <span class="badge orange">NEW</span>

                        </div>

                        <div class="card-label">Желаемая роль</div>

                        <div class="student-role">
                            Биоинформатик / Data Scientist
                        </div>

                        <div class="card-label">Навыки</div>

                        <div class="skills">
                            <span>R</span>
                            <span>Python</span>
                            <span>ML</span>
                            <span>Genetics</span>
                        </div>

                        <div class="card-actions">
                            <button class="profile-btn">Профиль</button>
                            <button class="message-btn">✉</button>
                        </div>

                    </div>

                    <!-- Card 3 -->
                    <div class="student-card">

                        <div class="student-header">

                            <div class="student-info">
                                <img src="https://i.pravatar.cc/100?img=15" alt="student">

                                <div>
                                    <h4>Иван Соколов</h4>

                                    <div class="student-meta">
                                        3 курс, Дизайн
                                    </div>
                                </div>
                            </div>

                            <span class="badge gray">VIEWED</span>

                        </div>

                        <div class="card-label">Желаемая роль</div>

                        <div class="student-role">
                            UI/UX Designer / Product Design
                        </div>

                        <div class="card-label">Навыки</div>

                        <div class="skills">
                            <span>Figma</span>
                            <span>Prototyping</span>
                            <span>User Research</span>
                        </div>

                        <div class="card-actions">
                            <button class="profile-btn">Профиль</button>
                            <button class="message-btn">✉</button>
                        </div>

                    </div>

                    <!-- Card 4 -->
                    <div class="student-card">

                        <div class="student-header">

                            <div class="student-info">
                                <img src="https://i.pravatar.cc/100?img=25" alt="student">

                                <div>
                                    <h4>Елена Кузнецова</h4>

                                    <div class="student-meta">
                                        4 курс, Менеджмент
                                    </div>
                                </div>
                            </div>

                            <span class="badge light-green">VERIFIED</span>

                        </div>

                        <div class="card-label">Желаемая роль</div>

                        <div class="student-role">
                            Project Manager Assistant
                        </div>

                        <div class="card-label">Навыки</div>

                        <div class="skills">
                            <span>Agile</span>
                            <span>Jira</span>
                            <span>English C1</span>
                        </div>

                        <div class="card-actions">
                            <button class="profile-btn">Профиль</button>
                            <button class="message-btn">✉</button>
                        </div>

                    </div>

                </div>

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

<script src="{{ asset('js/students-in-search.js') }}"></script>

</body>
</html>

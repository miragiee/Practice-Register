<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Профиль университета
    </title>

    @vite([
        'resources/css/university-profile.css',
        'resources/js/university-profile.js'
    ])
</head>
<body>

<main class="university-page">

    {{-- HERO --}}
    <section class="hero-section fade-in">

        <div class="hero-left">

            <div class="hero-logo">

                <img
                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                    alt="University Logo"
                >

            </div>

            <div class="hero-content">

                <div class="university-status">

                    ГОСУДАРСТВЕННЫЙ ВУЗ

                    <span class="verified-dot"></span>

                </div>

                <h1>
                     Московский Государственный Технический Университет им. Н.Э. Баумана
                </h1>

                <p>
                    Ведущий технический университет России, формирующий кадровый резерв для высокотехнологичных отраслей экономики.
                </p>

            </div>

        </div>

        <div class="hero-actions">

            <button class="settings-btn">
                ⚙ Настройки
            </button>

            <button class="edit-btn">
                ✎ Редактировать
            </button>

        </div>

    </section>

    {{-- STATS --}}
    <section class="stats-section fade-in">

        <div class="stats-grid">

            <div class="stat-card blue-card">

                <div class="stat-icon">
                    👨‍🎓
                </div>

                <div class="stat-value">
                    24.500+
                </div>

                <div class="stat-label">
                    АКТИВНЫХ СТУДЕНТОВ
                </div>

            </div>

            <div class="stat-card gray-card">

                <div class="stat-icon">
                    🏢
                </div>

                <div class="stat-value">
                    184
                </div>

                <div class="stat-label">
                    ПАРТНЕРОВ-КОМПАНИЙ
                </div>

            </div>

            <div class="stat-card yellow-card">

                <div class="stat-icon">
                    🛡
                </div>

                <div class="stat-value">
                    98%
                </div>

                <div class="stat-label">
                    ТРУДОУСТРОЙСТВО
                </div>

            </div>

        </div>

        <div class="documents-card">

            <h3>
                📄 Документы
            </h3>

            <div class="document-item">
                📕 Лицензия №1284-9
            </div>

            <div class="document-item">
                📕 Аккредитация 2024
            </div>

            <div class="document-item">
                📕 Устав университета
            </div>

        </div>

    </section>

    {{-- CONTENT --}}
    <section class="content-grid fade-in">

        {{-- ABOUT --}}
        <div class="about-card">

            <h2>
                Об университете
            </h2>

            <p>
                МГТУ им. Н.Э. Баумана — это национальный исследовательский университет техники и технологий,
                один из ведущих вузов России и Европы. Основанный в 1830 году, университет на протяжении почти двух столетий готовит высококласных инженеров и ученых.
            </p>

            <p>
                Сегодня наша миссия заключается в обеспечении технологического суверенитета страны через интеграцию образования,
                науки и реального производства. Мы активно развиваем систему "образование через практику", сотрудничая с крупнейшими ИТ-гигантами и промышленными холдингами.
            </p>

            <div class="tags">

                <span>#Инженерия</span>

                <span>#IT_Технологии</span>

                <span>#Космос</span>

                <span>#Робототехника</span>

            </div>

        </div>

        {{-- PRACTICES --}}
        <div class="practice-card">

            <h2>
                Активные практики
            </h2>

            <div class="practice-item">

                <div>

                    <h3>
                        Программная инженерия
                    </h3>

                    <p>
                        42 компании-партнера
                    </p>

                </div>

                <span>
                    ›
                </span>

            </div>

            <div class="practice-item">

                <div>

                    <h3>
                        Кибербезопасность
                    </h3>

                    <p>
                        15 активных потоков
                    </p>

                </div>

                <span>
                    ›
                </span>

            </div>

            <div class="practice-item">

                <div>

                    <h3>
                        Системы управления ИИ
                    </h3>

                    <p>
                        Новое направление
                    </p>

                </div>

                <span>
                    ›
                </span>

            </div>

            <button class="show-btn">
                Смотреть все (12)
            </button>

        </div>

    </section>

    {{-- CONTACTS --}}
    <section class="contacts-section fade-in">

        <h2>
            Контактные лица
        </h2>

        <div class="contacts-grid">

            <div class="contact-card">

                <div class="contact-avatar avatar-1"></div>

                <div>

                    <h3>
                        Иван Соколов
                    </h3>

                    <p>
                        Проректор по учебной работе
                    </p>

                </div>

            </div>

            <div class="contact-card">

                <div class="contact-avatar avatar-2"></div>

                <div>

                    <h3>
                        Елена Петрова
                    </h3>

                    <p>
                        Руководитель отдела практик
                    </p>

                </div>

            </div>

            <div class="contact-card add-card">

                <div class="add-circle">
                    +
                </div>

                <div>

                    <h3>
                        Добавить контакт
                    </h3>

                    <p>
                        Новое ответственное лицо
                    </p>

                </div>

            </div>

        </div>

    </section>



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

</body>
</html>

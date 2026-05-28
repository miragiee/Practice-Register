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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite([
        'resources/css/university-profile.css',
        'resources/js/university-profile.js',
        'resources/js/profile-documents.js'
    ])
</head>
<body>

<header class="page-header">
    <div class="header-container">
        <a href="{{ route('main.page') }}" class="page-logo">Практикум</a>
        <nav class="page-nav">
            <button class="page-nav-link logout-button" type="button">Выйти</button>
        </nav>
    </div>
</header>

<div class="modal-overlay hidden" id="edit-modal">
    <div class="modal-window">
        <div class="modal-header">
            <h2>Редактировать университет</h2>
            <button class="modal-close" type="button" aria-label="Закрыть">×</button>
        </div>
        <form id="university-edit-form">
            <div class="modal-field">
                <label for="edit-name">Название</label>
                <input id="edit-name" name="name" type="text" required />
            </div>
            <div class="modal-field">
                <label for="edit-inn">ИНН</label>
                <input id="edit-inn" name="inn" type="text" required />
            </div>
            <div class="modal-field">
                <label for="edit-contact-person">Контактное лицо</label>
                <input id="edit-contact-person" name="contact_person" type="text" required />
            </div>
            <div class="modal-field">
                <label for="edit-position">Должность</label>
                <input id="edit-position" name="position" type="text" required />
            </div>
            <div class="modal-field">
                <label for="edit-phone">Телефон</label>
                <input id="edit-phone" name="phone" type="text" required />
            </div>
            <div class="modal-actions">
                <button class="button button-secondary" type="button" id="edit-cancel">Отмена</button>
                <button class="button button-primary" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</div>

<main class="university-page">
    <section class="hero-section fade-in" data-university-id="{{ $university->id }}">

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

                <h1 id="university-name">{{ $university->name }}</h1>

                <p id="university-inn">
                    {{ $university->inn ? 'ИНН: ' . $university->inn : 'Университет без ИНН' }}
                </p>

                <p id="university-contact">
                    {{ $university->contact_person ? 'Контактное лицо: ' . $university->contact_person . ' (' . $university->position . ')' : 'Информация о контактном лице отсутствует' }}
                </p>

                <p id="university-phone">
                    {{ $university->phone ? 'Телефон: ' . $university->phone : 'Телефон не указан' }}
                </p>

            </div>

        </div>

        <div class="hero-actions">
            <a href="{{ route('internships.create') }}" class="create-practice-btn">
                ➕ Создать практику
            </a>
            <a href="{{ route('university.calendar') }}" class="calendar-btn">
                📅 Календарь практик
            </a>
            <button class="edit-btn" type="button">
                ✎ Редактировать
            </button>
            <button class="partnerships-btn" data-url="{{ route('partnerships') }}" type="button">
                🤝 Партнёрства
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
                    {{ $university->students()->count() }}
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
                    {{ $university->contracts()->distinct('company_id')->count() }}
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
                    {{ $university->internships()->count() }}
                </div>

                <div class="stat-label">
                    АКТИВНЫХ ПРАКТИК
                </div>

            </div>

        </div>

        <div class="documents-card">

            <h3>
                📄 Документы
            </h3>

            <p class="document-description">
                Загрузите документы, связанные с практиками студентов вашего вуза.
            </p>

            <div class="document-item">
                <form id="profile-document-form" action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <label for="profile-student-internship-select">Стажировка</label>
                        <select id="profile-student-internship-select" name="student_internship_id" required>
                            <option value="">Загрузка...</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="profile-file">Файл</label>
                        <input type="file" id="profile-file" name="file" required />
                    </div>

                    <div class="form-row">
                        <label for="profile-type">Тип</label>
                        <input type="text" id="profile-type" name="type" required />
                    </div>

                    <button type="submit" class="upload-button">Загрузить</button>
                </form>
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

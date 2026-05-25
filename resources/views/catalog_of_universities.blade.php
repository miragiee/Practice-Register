<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        http-equiv="X-UA-Compatible"
        content="ie=edge"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        Каталог вузов-партнеров
    </title>

    @vite([
        'resources/js/catalog_of_universities.blade.js',
        'resources/css/catalog_of_universities.blade.css'
    ])

</head>

<body>

<div class="page">

    {{-- HEADER --}}
    {{--<header class="topbar">

        <div class="container topbar-inner">

            <div class="logo">
                Практикум
            </div>

            <nav class="nav">

                <a href="#">
                    Студентам
                </a>

                <a href="#">
                    Университетам
                </a>

                <a
                    href="#"
                    class="active"
                >
                    Каталог вузов
                </a>

                <a href="#">
                    Тарифы
                </a>

            </nav>

            <div class="profile">
                Профиль
            </div>

        </div>

    </header> --}}

    <div class="container">

        {{-- BREADCRUMBS --}}
        <div class="breadcrumbs">

            <a href="#">
                Личный кабинет
            </a>

            <span>
                >
            </span>

            <span>
                Поиск вузов
            </span>

        </div>

        {{-- HERO --}}
        <div class="hero">

            <h1>
                Каталог вузов-партнеров
            </h1>

            <p>
                Найдите идеальный академический фундамент для ваших будущих сотрудников.
                Просматривайте профили вузов и выбирайте талантливых стажеров напрямую.
            </p>

        </div>

        {{-- SEARCH --}}
        <div class="search-section">

            <div class="search-box">

                <input
                    type="text"
                    id="search"
                    placeholder="Поиск по названию вуза, городу или направлению подготовки..."
                >

                <button type="button">
                    Найти
                </button>

            </div>

            <div class="partners-card">

                <span>
                    Активных партнеров
                </span>

                <h2>
                    124
                </h2>

                <div class="partners-icon">
                    🎓
                </div>

            </div>

        </div>

        {{-- UNIVERSITY CARDS --}}
        <div class="universities-grid">

            {{-- CARD --}}
            <div class="university-card">

                <div class="card-image">

                    <img
                        src="{{ asset('storage/avatars/Building-1.png') }}"
                        alt="Бауманка"
                    >

                    <div class="rating">
                        ★ 4.9
                    </div>

                </div>

                <div class="card-content">

                    <h3>
                        МГТУ им. Н.Э. Баумана
                    </h3>

                    <p>
                        Ведущий технический университет России с сильной базой
                        в области робототехники и IT.
                    </p>

                    <div class="tags">

                        <span>
                            Робототехника
                        </span>

                        <span>
                            Data Science
                        </span>

                    </div>

                    <div class="card-footer">

                        <div>

                            <small>
                                СТУДЕНТОВ ДОСТУПНО
                            </small>

                            <strong>
                                1240
                            </strong>

                        </div>

                        <a href="#">
                            Просмотр →
                        </a>

                    </div>

                </div>

            </div>

            {{-- CARD --}}
            <div class="university-card">

                <div class="card-image">

                    <img
                        src="{{ asset('storage/avatars/Building-2.png') }}"
                        alt="ВШЭ"
                    >

                    <div class="rating">
                        ★ 4.8
                    </div>

                </div>

                <div class="card-content">

                    <h3>
                        НИУ ВШЭ
                    </h3>

                    <p>
                        Фокус на экономику, социальные науки и современные
                        цифровые технологии в бизнесе.
                    </p>

                    <div class="tags">

                        <span>
                            Бизнес-аналитика
                        </span>

                        <span>
                            UX дизайн
                        </span>

                    </div>

                    <div class="card-footer">

                        <div>

                            <small>
                                СТУДЕНТОВ ДОСТУПНО
                            </small>

                            <strong>
                                856
                            </strong>

                        </div>

                        <a href="#">
                            Просмотр →
                        </a>

                    </div>

                </div>

            </div>

            {{-- CARD --}}
            <div class="university-card">

                <div class="card-image">

                    <img
                        src="{{ asset('storage/avatars/Building-3.png') }}"
                        alt="ИТМО"
                    >

                    <div class="rating">
                        ★ 4.7
                    </div>

                </div>

                <div class="card-content">

                    <h3>
                        ИТМО
                    </h3>

                    <p>
                        Первый исследовательский университет.
                        Мировые лидеры в олимпиадном программировании.
                    </p>

                    <div class="tags">

                        <span>
                            AI & ML
                        </span>

                        <span>
                            Разработка
                        </span>

                    </div>

                    <div class="card-footer">

                        <div>

                            <small>
                                СТУДЕНТОВ ДОСТУПНО
                            </small>

                            <strong>
                                2105
                            </strong>

                        </div>

                        <a href="#">
                            Просмотр →
                        </a>

                    </div>

                </div>

            </div>

        </div>

        {{-- CANDIDATES --}}
        <div class="candidates-section">

            <div class="candidates-header">

                <div>

                    <h2>
                        Рекомендованные кандидаты
                    </h2>

                    <p>
                        На основе ваших открытых вакансий и профилей вузов-партнеров
                    </p>

                </div>

                <div class="header-actions">

                    <button class="filter-btn">
                        Фильтры
                    </button>

                    <button class="export-btn">
                        Экспорт списка
                    </button>

                </div>

            </div>

            <table>

                <thead>

                <tr>

                    <th>
                        СТУДЕНТ
                    </th>

                    <th>
                        ВУЗ
                    </th>

                    <th>
                        СПЕЦИАЛИЗАЦИЯ
                    </th>

                    <th>
                        РЕЙТИНГ
                    </th>

                    <th>
                        СТАТУС
                    </th>

                    <th>
                        ДЕЙСТВИЕ
                    </th>

                </tr>

                </thead>

                <tbody>

                <tr>

                    <td>

                        <div class="student-info">

                            <div class="avatar blue">
                                AB
                            </div>

                            <div>

                                <strong>
                                    Александр Волков
                                </strong>

                                <span>
                                    4 курс, Бакалавр
                                </span>

                            </div>

                        </div>

                    </td>

                    <td>
                        МГТУ им. Баумана
                    </td>

                    <td>
                        Software Engineer
                    </td>

                    <td class="green">
                        ⚡ 98% Match
                    </td>

                    <td>

                        <span class="status success">
                            Готов к офферу
                        </span>

                    </td>

                    <td>

                        <a href="#">
                            Профиль
                        </a>

                    </td>

                </tr>

                <tr>

                    <td>

                        <div class="student-info">

                            <div class="avatar beige">
                                EC
                            </div>

                            <div>

                                <strong>
                                    Елена Соколова
                                </strong>

                                <span>
                                    4 курс, Магистратура
                                </span>

                            </div>

                        </div>

                    </td>

                    <td>
                        НИУ ВШЭ
                    </td>

                    <td>
                        Data Scientist
                    </td>

                    <td class="green">
                        ⚡ 94% Match
                    </td>

                    <td>

                        <span class="status warning">
                            На стажировке
                        </span>

                    </td>

                    <td>

                        <a href="#">
                            Профиль
                        </a>

                    </td>

                </tr>

                <tr>

                    <td>

                        <div class="student-info">

                            <div class="avatar orange">
                                ДК
                            </div>

                            <div>

                                <strong>
                                    Дмитрий Кузнецов
                                </strong>

                                <span>
                                    3 курс, Бакалавр
                                </span>

                            </div>

                        </div>

                    </td>

                    <td>
                        ИТМО
                    </td>

                    <td>
                        Frontend Dev
                    </td>

                    <td class="green">
                        ⚡ 91% Match
                    </td>

                    <td>

                        <span class="status success">
                            Готов к офферу
                        </span>

                    </td>

                    <td>

                        <a href="#">
                            Профиль
                        </a>

                    </td>

                </tr>

                </tbody>

            </table>

            <div class="show-more">
                Показать еще ↓
            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="footer">

        <div class="container footer-grid">

            <div>

                <div class="footer-logo">
                    Практикум
                </div>

                <p>
                    © 2024 Практикум. Платформа для развития кадрового потенциала.
                </p>

            </div>

            <div>

                <h4>
                    РЕСУРСЫ
                </h4>

                <a href="#">
                    О платформе
                </a>

                <a href="#">
                    Центр помощи
                </a>

                <a href="#">
                    Карьера
                </a>

            </div>

            <div>

                <h4>
                    ПРАВО
                </h4>

                <a href="#">
                    Партнерам
                </a>

                <a href="#">
                    Конфиденциальность
                </a>

                <a href="#">
                    Условия использования
                </a>

            </div>

        </div>

    </footer>

</div>

</body>
</html>

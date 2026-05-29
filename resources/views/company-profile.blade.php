{{-- resources/views/company-profile.blade.php --}}

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Профиль компании
    </title>

    @vite([
        'resources/css/company-profile.css',
        'resources/js/company-profile.js',
        'resources/js/profile-documents.js'
    ])
</head>
<body>

<header class="header">

    <div
        class="header-logo"
        onclick="window.location='{{ route('main.page') }}'"
    >
        Практикум
    </div>

    <nav class="header-nav">
        <a href="#">Студентам</a>
        <a href="#">Университетам</a>
        <a href="#" class="active">Компаниям</a>
        <a href="#">Тарифы</a>        <a href="{{ route('help') }}">Помощь</a>    </nav>

</header>

<main class="main-container">

    {{-- COMPANY HEADER --}}
    <section class="company-header fade-in">

        <div class="company-header-left">

            <div class="company-logo">

                <svg viewBox="0 0 24 24">
                    <path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z"/>
                </svg>

            </div>

            <div class="company-info">

                <h1>
                    {{ $company->name }}
                </h1>

                <p>
                    {{ $company->description ?? 'Разработка IT-решений и стажировок' }}
                </p>

            </div>

        </div>

        <div class="buttons">
            <button
            class="add-vacancy-btn"
            id="add-vacancy-btn"
            data-url="{{ route('profile.company-requests.index') }}"
        >

            <svg viewBox="0 0 24 24" fill="none">
                <path
                    d="M12 5V19M5 12H19"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />
            </svg>

            Добавить вакансию

        </button>

        <button
           class="add-vacancy-btn partnerships-btn"
           data-url="{{ route('partnerships') }}"
        >

           <svg viewBox="0 0 24 24" fill="none">
               <path
                   d="M7 12h10M12 7l5 5-5 5"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round"
               />
           </svg>

           Партнёрства

        </button>

        <a href="{{ route('company.calendar') }}" class="add-vacancy-btn calendar-btn">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M8 7V4M16 7V4M5 11h14M5 19h14M6 5h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Календарь вузов
        </a>
        </div>

    </section>

    {{-- ABOUT --}}
    <section class="about-section fade-in">

        <div class="content-card">

            <h2 class="section-title">
                О компании
            </h2>

            <p class="about-text">
                {{ $company->description
                    ?? 'Компания активно развивает программы стажировок и практики для студентов. Мы создаём современные решения, развиваем IT-направления и помогаем молодым специалистам начать карьеру.' }}
            </p>

        </div>

        <div class="stats-card">

            <div class="stat-item">

                <div class="stat-icon">

                    <svg viewBox="0 0 24 24">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>

                </div>

                <div>

                    <div class="stat-value">
                        {{ $vacancyCount }}
                    </div>

                    <div class="stat-label">
                        активных вакансий
                    </div>

                </div>

            </div>

            <div class="stat-item documents-upload">

                <h4>Загрузить документ</h4>

                <form id="profile-document-form" action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <p>
                        <label for="profile-student-internship-select">Стажировка</label>
                        <select id="profile-student-internship-select" name="student_internship_id" required>
                            <option value="">Загрузка...</option>
                        </select>
                    </p>

                    <p>
                        <label for="profile-file">Файл</label>
                        <input type="file" id="profile-file" name="file" />
                    </p>

                    <p>
                        <label for="profile-type">Тип</label>
                        <input type="text" id="profile-type" name="type" required />
                    </p>

                    <button type="submit">Загрузить</button>
                </form>

            </div>

            <div class="stat-item">

                <div class="stat-icon">

                    <svg viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
                        10-4.48 10-10S17.52 2 12 2zm6.93 6h-2.95
                        c-.21-1.37-.72-2.63-1.47-3.68
                        1.84.63 3.36 2.01 4.42 3.68zM12
                        4c.83 1.2 1.4 2.58 1.63 4h-3.26C10.6
                        6.58 11.17 5.2 12 4zM4.26 14a7.93 7.93
                        0 010-4h3.49a15.6 15.6 0 000
                        4H4.26zm.81 2h2.95c.21 1.37.72 2.63
                        1.47 3.68A8.014 8.014 0 015.07
                        16zM8.02 8H5.07a8.014 8.014 0 014.42-3.68A9.93
                        9.93 0 008.02 8zm3.98
                        12c-.83-1.2-1.4-2.58-1.63-4h3.26c-.23
                        1.42-.8 2.8-1.63 4zm2.06-6H9.94a13.6
                        13.6 0 010-4h4.12a13.6 13.6 0 010
                        4zm.45 5.68c.75-1.05 1.26-2.31
                        1.47-3.68h2.95a8.014 8.014 0 01-4.42
                        3.68zM16.24 14a15.6 15.6 0 000-4h3.49a7.93
                        7.93 0 010 4h-3.49z"/>
                    </svg>

                </div>

                <div>

                    <div class="stat-value">
                        {{ $assignedCount }}
                    </div>

                    <div class="stat-label">
                        назначенных студентов
                    </div>

                </div>

            </div>

            <div class="stat-item">

                <div class="stat-icon">

                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12
                        3zm0 13L3.74 11.5 12 7l8.26 4.5L12
                        16zm-7 2v2h14v-2H5z"/>
                    </svg>

                </div>

                <div>

                    <div class="stat-value">
                        {{ $activeReservationsCount }}
                    </div>

                    <div class="stat-label">
                        активных бронирований
                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- ADVANTAGES --}}
    <section class="advantages-section fade-in">

        <h2 class="section-title-large">
            Наши преимущества для стажеров
        </h2>

        <div class="advantages-grid">

            <div class="advantage-card">

                <div class="advantage-icon">
                    🚀
                </div>

                <div class="advantage-title">
                    Быстрый старт
                </div>

                <div class="advantage-desc">
                    Реальные задачи с первого дня и полное погружение в разработку.
                </div>

            </div>

            <div class="advantage-card">

                <div class="advantage-icon">
                    🎯
                </div>

                <div class="advantage-title">
                    Менторство
                </div>

                <div class="advantage-desc">
                    За каждым стажером закрепляется Senior-специалист.
                </div>

            </div>

            <div class="advantage-card">

                <div class="advantage-icon">
                    ☕
                </div>

                <div class="advantage-title">
                    Культура и быт
                </div>

                <div class="advantage-desc">
                    Современный офис, гибкий график и доступ к корпоративной библиотеке.
                </div>

            </div>

        </div>

    </section>

    {{-- VACANCIES --}}
    <section class="vacancies-section fade-in">

        <div class="vacancies-header">

            <h2 class="section-title-large">
                Активные вакансии практики
            </h2>

            <div class="vacancies-badge">
                {{ $vacancyCount }} доступно
            </div>

        </div>

        <div class="vacancies-grid">

            @forelse($companyRequests as $vacancy)
                @php
                    $skills = collect($vacancy->internship->qualities ?? [])
                        ->merge($vacancy->requirements_tags)
                        ->unique()
                        ->take(6);
                @endphp

                <div class="vacancy-card">

                    <div class="vacancy-top">

                        <div class="vacancy-type type-remote">
                            Практика
                        </div>

                        <div class="vacancy-bookmark">
                            ☆
                        </div>

                    </div>

                    <div class="vacancy-title">
                        {{ $vacancy->internship->title ?? 'Практика' }}
                    </div>

                    <div class="vacancy-desc">
                        {{ Str::limit($vacancy->requirements_text, 120) }}
                    </div>

                    <div class="vacancy-tags">
                        @foreach($skills as $skill)
                            <div class="vacancy-tag">
                                {{ $skill }}
                            </div>
                        @endforeach
                    </div>

                    <div class="vacancy-footer">

                        <div class="vacancy-format">
                            Нужно: {{ $vacancy->required_count }} студент{{ $vacancy->required_count === 1 ? '' : 'а' }}
                        </div>

                        <a href="{{ route('profile.company-requests.show', $vacancy->id) }}" class="vacancy-detail-link">
                            Детали →
                        </a>

                    </div>

                </div>
            @empty
                <div class="empty-state">
                    У вас пока нет активных вакансий. <a href="{{ route('profile.company-requests.create') }}">Создать заявку</a>
                </div>
            @endforelse

        </div>

    </section>

    <section class="reservations-section fade-in">

        <div class="section-header">

            <h2 class="section-title-large">
                Бронирования компании
            </h2>

            <div class="vacancies-badge">
                {{ $companyReservations->count() }} записей
            </div>

        </div>

        <div class="reservations-list">

            @forelse($companyReservations as $reservation)
                <article class="reservation-row">

                    <div class="reservation-main">
                        <div class="reservation-title">
                            {{ $reservation->student->full_name ?? 'Студент' }} · {{ $reservation->internship->title ?? 'Практика' }}
                        </div>
                        <div class="reservation-meta">
                            {{ $reservation->status }} · {{ $reservation->created_at->format('d.m.Y') }}
                        </div>
                    </div>

                    <div class="reservation-actions">
                        <span class="reservation-status-badge status-{{ strtolower($reservation->status) }}">
                            {{ $reservation->status }}
                        </span>
                        @if($reservation->status !== 'cancelled')
                            <button
                                type="button"
                                class="cancel-reservation-btn"
                                data-action="{{ route('reservations.cancel-by-company', $reservation) }}"
                            >
                                Отменить
                            </button>
                        @endif
                    </div>

                </article>
            @empty
                <div class="empty-state">
                    Бронирований пока нет.
                </div>
            @endforelse

        </div>

    </section>

    {{-- BOTTOM --}}
    <section class="bottom-section fade-in">

        {{-- GALLERY --}}
        <div>

            <h2 class="section-title-large">
                Галерея офиса
            </h2>

            <div class="gallery-grid">

                <div class="gallery-item">
                    <div class="gallery-placeholder gallery-placeholder-1">
                        🏢
                    </div>
                </div>

                <div class="gallery-item">
                    <div class="gallery-placeholder gallery-placeholder-2">
                        💼
                    </div>
                </div>

                <div class="gallery-item">
                    <div class="gallery-placeholder gallery-placeholder-3">
                        🖥
                    </div>
                </div>

            </div>

        </div>

        {{-- HR --}}
        <div class="hr-card">

            <h2 class="section-title">
                Контакты HR
            </h2>

            <div class="hr-person">

                <div class="hr-avatar">
                    👩
                </div>

                <div>

                    <div class="hr-name">
                        HR отдел
                    </div>

                    <div class="hr-role">
                        Talent Acquisition
                    </div>

                </div>

            </div>

            <div class="hr-contact-item">
                ✉ {{ $company->contact_info }}
            </div>

            <div class="hr-contact-item">
                ☎ +7 (900) 123-45-67
            </div>

            <div class="hr-contact-item">
                🌐 {{ $company->website ?? 'company.ru' }}
            </div>

        </div>

    </section>

</main>

<footer class="footer">

    <div class="footer-inner">

        <div class="footer-brand">

            <div class="footer-brand-name">
                Практикум
            </div>

            <div class="footer-brand-desc">
                Платформа для развития кадрового потенциала и связи образования с бизнесом.
            </div>

        </div>

        <div class="footer-links">

            <div class="footer-col">

                <div class="footer-col-title">
                    Ресурс
                </div>

                <a href="#">
                    О платформе
                </a>

                <a href="#">
                    Центр помощи
                </a>

            </div>

            <div class="footer-col">

                <div class="footer-col-title">
                    Компания
                </div>

                <a href="#">
                    Карьера
                </a>

                <a href="#">
                    Партнёрам
                </a>

            </div>

            <div class="footer-col">

                <div class="footer-col-title">
                    Право
                </div>

                <a href="#">
                    Конфиденциальность
                </a>

            </div>

        </div>

    </div>

</footer>

</body>
</html>

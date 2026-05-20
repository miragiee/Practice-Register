{{-- admin_panel.blade.php --}}
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Административная панель</title>
    @vite(['resources/js/app.js', 'resources/css/admin.css'])
</head>
<body>
    <div class="container">
        {{-- Заголовок с приветствием и логаутом --}}
        <div class="header">
            <h1>⚙️ Административная панель</h1>
            <p>Управление всеми сущностями системы — компании, университеты, студенты, стажировки, контракты и многое другое.</p>
            <form class="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">🚪 Выйти</button>
            </form>
        </div>

        {{-- ================= КАТЕГОРИЯ: ОСНОВНЫЕ СУЩНОСТИ ================= --}}
        <h2 class="section-title">📋 Основные модули CRUD</h2>
        <div class="cards-grid">
            {{-- Компании --}}
            <a href="{{ route('companies.index') }}" class="card">
                <div class="card-icon">🏢</div>
                <div class="card-title">Компании</div>
                <div class="card-desc">Список, создание, редактирование и удаление компаний-партнёров.</div>
                <span class="badge">companies</span>
            </a>

            {{-- Университеты --}}
            <a href="{{ route('universities.index') }}" class="card">
                <div class="card-icon">🎓</div>
                <div class="card-title">Университеты</div>
                <div class="card-desc">Управление учебными заведениями: название, город, контакты.</div>
                <span class="badge">universities</span>
            </a>

            {{-- Студенты --}}
            <a href="{{ route('students.index') }}" class="card">
                <div class="card-icon">👨‍🎓</div>
                <div class="card-title">Студенты</div>
                <div class="card-desc">Добавление, обновление, удаление студентов. ФИО, курс, почта и т.д.</div>
                <span class="badge">students</span>
            </a>

            {{-- Направления --}}
            <a href="{{ route('directions.index') }}" class="card">
                <div class="card-icon">🧭</div>
                <div class="card-title">Направления</div>
                <div class="card-desc">Названия и описания образовательных направлений.</div>
                <span class="badge">directions</span>
            </a>

            {{-- Стажировки --}}
            <a href="{{ route('internships.index') }}" class="card">
                <div class="card-icon">💼</div>
                <div class="card-title">Стажировки</div>
                <div class="card-desc">Управление программами стажировок: даты, описание, привязка к университету.</div>
                <span class="badge">internships</span>
            </a>

            {{-- Контракты --}}
            <a href="{{ route('contracts.index') }}" class="card">
                <div class="card-icon">📄</div>
                <div class="card-title">Контракты</div>
                <div class="card-desc">Договоры между университетами и компаниями: сроки, статус.</div>
                <span class="badge">contracts</span>
            </a>

            {{-- Резервации (Reservations) --}}
            <a href="{{ route('reservations.index') }}" class="card">
                <div class="card-icon">📅</div>
                <div class="card-title">Резервации</div>
                <div class="card-desc">Связь студента, компании и стажировки с указанием статуса.</div>
                <span class="badge">reservations</span>
            </a>

            {{-- Документы --}}
            <a href="{{ route('documents.index') }}" class="card">
                <div class="card-icon">📁</div>
                <div class="card-title">Документы</div>
                <div class="card-desc">Пути к файлам, типы документов, привязка к студенческим стажировкам.</div>
                <span class="badge">documents</span>
            </a>

            {{-- Студенческие стажировки --}}
            <a href="{{ route('student-internships.index') }}" class="card">
                <div class="card-icon">🔄</div>
                <div class="card-title">Стажировки студентов</div>
                <div class="card-desc">Связка студент → компания → стажировка с отслеживанием статуса.</div>
                <span class="badge">student-internships</span>
            </a>
        </div>

        {{-- ================= КАТЕГОРИЯ: АУТЕНТИФИКАЦИЯ И ПРОФИЛИ ================= --}}
        <h2 class="section-title">🔐 Аутентификация и профили</h2>
        <div class="cards-grid">
            <a href="{{ route('register') }}" class="card">
                <div class="card-icon">📝</div>
                <div class="card-title">Регистрация (шаг 1)</div>
                <div class="card-desc">Начало регистрации — выбор роли (студент/компания/университет).</div>
            </a>
            <a href="{{ route('register-step-2-company') }}" class="card">
                <div class="card-icon">🏢+</div>
                <div class="card-title">Регистрация: шаг 2 (компания)</div>
                <div class="card-desc">Заполнение данных компании.</div>
            </a>
            <a href="{{ route('register-step-2-university') }}" class="card">
                <div class="card-icon">🎓+</div>
                <div class="card-title">Регистрация: шаг 2 (университет)</div>
                <div class="card-desc">Заполнение данных университета.</div>
            </a>
            <a href="{{ route('register-step-3') }}" class="card">
                <div class="card-icon">✅</div>
                <div class="card-title">Регистрация: шаг 3</div>
                <div class="card-desc">Завершение регистрации и создание учётной записи.</div>
            </a>
            <a href="{{ route('auth') }}" class="card">
                <div class="card-icon">🔑</div>
                <div class="card-title">Вход в систему</div>
                <div class="card-desc">Страница авторизации (студент/компания/университет).</div>
            </a>
            <a href="{{ route('student-profile') }}" class="card">
                <div class="card-icon">👤</div>
                <div class="card-title">Профиль студента</div>
                <div class="card-desc">Личный кабинет студента (только для авторизованных).</div>
            </a>
            <a href="{{ route('company-profile') }}" class="card">
                <div class="card-icon">🏢👤</div>
                <div class="card-title">Профиль компании</div>
                <div class="card-desc">Личный кабинет представителя компании.</div>
            </a>
        </div>

        {{-- ================= КАТЕГОРИЯ: ДОПОЛНИТЕЛЬНЫЕ СТРАНИЦЫ ================= --}}
        <h2 class="section-title">🌐 Навигация по системе</h2>
        <div class="cards-grid">
            <a href="{{ route('main.page') }}" class="card">
                <div class="card-icon">🏠</div>
                <div class="card-title">Главная страница</div>
                <div class="card-desc">Основная публичная страница портала.</div>
            </a>
            <a href="{{ route('students-in-search') }}" class="card">
                <div class="card-icon">🔍</div>
                <div class="card-title">Поиск студентов</div>
                <div class="card-desc">Поиск студентов по различным критериям.</div>
            </a>
        </div>

        {{-- быстрые ссылки для удобства (альтернативный вид) --}}
        <hr>
        <div style="margin-top: 1rem;">
            <span style="font-weight: 500;">⚡ Быстрые ссылки: </span>
            <div class="extra-links">
                <a href="{{ route('companies.index') }}" class="extra-link">Компании</a>
                <a href="{{ route('universities.index') }}" class="extra-link">Университеты</a>
                <a href="{{ route('students.index') }}" class="extra-link">Студенты</a>
                <a href="{{ route('internships.index') }}" class="extra-link">Стажировки</a>
                <a href="{{ route('contracts.index') }}" class="extra-link">Контракты</a>
                <a href="{{ route('reservations.index') }}" class="extra-link">Резервации</a>
                <a href="{{ route('documents.index') }}" class="extra-link">Документы</a>
                <a href="{{ route('student-internships.index') }}" class="extra-link">Стаж. студентов</a>
                <a href="{{ route('auth') }}" class="extra-link">Вход</a>
                <a href="{{ route('main.page') }}" class="extra-link">Главная</a>
            </div>
        </div>

        <footer>
            Административная панель управления | Laravel CRUD | Все права защищены армией РФ
        </footer>
    </div>
</body>
</html>

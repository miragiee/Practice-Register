<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Партнёры</title>

    @vite([
        'resources/css/partnerships.css',
        'resources/js/partnerships.js'
    ])
</head>
<body>

<div class="layout">

    {{-- Sidebar --}}
    <aside class="sidebar">

        <div>

            <div class="logo">

                <div class="logo-icon">
                    ✦
                </div>

                <div>
                    <h2>Global Network</h2>
                    <p>Enterprise Admin</p>
                </div>

            </div>

            <nav class="sidebar-nav">
                <a href="#" class="nav-item">
                    <span>◈</span>
                    <span>Профиль</span>
                </a>

                <a href="#" class="nav-item active">
                    <span>◈</span>
                    <span>Партнёры</span>
                </a>

                <a href="#" class="nav-item">
                    <span>◉</span>
                    <span>Студенты</span>
                </a>

                <a href="#" class="nav-item">
                    <span>⚙</span>
                    <span>Настройки</span>
                </a>

            </nav>

        </div>

        <div class="sidebar-bottom">

            <a href="#" class="bottom-link">
                Выйти
            </a>

        </div>

    </aside>

    {{-- Main Content --}}
    <main class="content">

        {{-- Header --}}
        <header class="topbar topbar-simple">

            <div class="topbar-right">

                <div class="profile">

                    <div class="profile-info">

                        <h4>Пользователь</h4>
                        <p>Система управления</p>

                    </div>

                    <div class="avatar-placeholder">
                        П
                    </div>

                </div>

            </div>

        </header>

        {{-- Breadcrumbs --}}
        <div class="breadcrumbs">
            ГЛАВНАЯ > ПАРТНЁРЫ
        </div>

        {{-- Heading --}}
        <section class="page-heading">

            <div>

                <h1>Партнёрская сеть</h1>

                <p>
                    Управление стратегическими альянсами и академическим сотрудничеством.
                </p>

            </div>

            <div class="actions">

                <button class="secondary-btn">
                    Фильтры
                </button>

                <button class="primary-btn">
                    Новый партнер
                </button>

            </div>

        </section>

        {{-- Table --}}
        <section class="table-wrapper">

            <div class="table-header">

                <h2>Список партнёров</h2>

                <div class="table-count">
                    Показывать по:
                    <strong>10</strong>
                </div>

            </div>

            <table>

                <thead>

                <tr>
                    <th>Организация</th>
                    <th>Индустрия</th>
                    <th>Статус</th>
                    <th>Контракты</th>
                    <th>Действия</th>
                </tr>

                </thead>

                <tbody>

                <tr>

                    <td>

                        <div class="company">

                            <div class="company-logo"></div>

                            <div>
                                <h4>ТехноЛогика Групп</h4>
                                <p>ID: TL-2024-001</p>
                            </div>

                        </div>

                    </td>

                    <td>IT и Разработка</td>

                    <td>
                        <span class="status success">
                            Генеральный партнер
                        </span>
                    </td>

                    <td>
                        <span class="contracts">
                            12 активных
                        </span>
                    </td>

                    <td>⋮</td>

                </tr>

                <tr>

                    <td>

                        <div class="company">

                            <div class="company-logo"></div>

                            <div>
                                <h4>ЭкоЭнерго Системы</h4>
                                <p>ID: EE-2023-452</p>
                            </div>

                        </div>

                    </td>

                    <td>Энергетика</td>

                    <td>
                        <span class="status warning">
                            Пролонгация
                        </span>
                    </td>

                    <td>
                        <span class="contracts">
                            4 активных
                        </span>
                    </td>

                    <td>⋮</td>

                </tr>

                <tr>

                    <td>

                        <div class="company">

                            <div class="company-logo"></div>

                            <div>
                                <h4>МедТех Инновации</h4>
                                <p>ID: MT-2024-089</p>
                            </div>

                        </div>

                    </td>

                    <td>Биотехнологии</td>

                    <td>
                        <span class="status success">
                            Действующий
                        </span>
                    </td>

                    <td>
                        <span class="contracts">
                            8 активных
                        </span>
                    </td>

                    <td>⋮</td>

                </tr>

                <tr>

                    <td>

                        <div class="company">

                            <div class="company-logo"></div>

                            <div>
                                <h4>ФинТраст Банк</h4>
                                <p>ID: FT-2022-112</p>
                            </div>

                        </div>

                    </td>

                    <td>Финтех</td>

                    <td>
                        <span class="status archive">
                            Архив
                        </span>
                    </td>

                    <td>
                        <span class="contracts inactive">
                            0 активных
                        </span>
                    </td>

                    <td>⋮</td>

                </tr>

                </tbody>

            </table>

        </section>

{{-- Incoming Requests --}}
<section class="requests-wrapper">

    <div class="table-header">

        <h2>Входящие заявки</h2>

        <div class="table-count">
            Всего:
            <strong>{{ $requests->count() }}</strong>
        </div>

    </div>

    <table>

        <thead>

        <tr>
            <th>ID</th>
            <th>Компания</th>
            <th>Университет</th>
            <th>Статус компании</th>
            <th>Статус университета</th>
            <th>Общий статус</th>
        </tr>

        </thead>

        <tbody>

        @foreach($requests as $request)

            <tr>

                <td>#{{ $request->id }}</td>

                <td>
                    Компания ID:
                    <strong>{{ $request->company_id }}</strong>
                </td>

                <td>
                    Университет ID:
                    <strong>{{ $request->university_id }}</strong>
                </td>

                <td>

                    @if($request->company_accept)
                        <span class="status success">
                            Подтверждено
                        </span>
                    @else
                        <span class="status archive">
                            Ожидание
                        </span>
                    @endif

                </td>

                <td>

                    @if($request->university_accept)
                        <span class="status success">
                            Подтверждено
                        </span>
                    @else
                        <span class="status archive">
                            Ожидание
                        </span>
                    @endif

                </td>

                <td>

                    @if($request->company_accept && $request->university_accept)

                        <span class="status success">
                            Партнёрство активно
                        </span>

                    @elseif(!$request->company_accept && !$request->university_accept)

                        <span class="status warning">
                            Новая заявка
                        </span>

                    @else

                        <span class="status warning">
                            Ожидает подтверждения
                        </span>

                    @endif

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</section>

    </main>

</div>

</body>
</html>

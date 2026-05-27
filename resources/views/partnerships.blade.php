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
                <div class="logo-icon">✦</div>

                <div>
                    <h2>Практикум</h2>
                    <p>Партнёрства</p>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="#" class="nav-item" data-view="partners">
                    <span>◈</span>
                    <span>Партнёры</span>
                </a>

                <a href="#" class="nav-item" data-view="students">
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
            <a href="#" class="bottom-link">Выйти</a>
        </div>

    </aside>

    {{-- Main --}}
    <main class="content">

        <header class="topbar topbar-simple">
            <div class="topbar-right">
                <div class="profile">
                    <div class="profile-info">
                        <h4>{{ $user->name }}</h4>
                        <p>{{ $user->email }}</p>
                    </div>

                    <div class="avatar-placeholder">П</div>
                </div>
            </div>
        </header>

        {{-- PARTNERS VIEW --}}
        <div id="view-partners">
            @include('partials.partner-list')
        </div>

        {{-- STUDENTS VIEW --}}
        <div id="view-students" style="display:none;">
            @include('partials.student-list')
        </div>

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

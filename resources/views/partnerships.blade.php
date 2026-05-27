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
                {{-- Кнопка возврата в профиль --}}
                <a href="{{ $profileUrl }}" class="nav-item">
                    <span>←</span>
                    <span>В профиль</span>
                </a>

                <a href="#" class="nav-item" data-view="partners">
                    <span>◈</span>
                    <span>Партнёры</span>
                </a>

                <a href="#" class="nav-item" data-view="students">
                    <span>◉</span>
                    <span>Студенты</span>
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

    </main>

</div>

</body>
</html>
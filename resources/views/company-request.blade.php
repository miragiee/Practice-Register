<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Заявки компаний</title>

    @vite([
        'resources/css/company-request.css',
        'resources/js/company-request.js'
    ])
</head>
<body>

<header>
    <div class="header-nav">

        <div class="header-left-side">

            <div class="logo">
                Практикум
            </div>

            <div class="link-list">
                <a href="#">Студентам</a>
                <a href="#">Университетам</a>
                <a href="#" class="active">Компаниям</a>
            </div>

        </div>

        <div class="profile-link">
            Профиль
        </div>

    </div>
</header>

<main>

    <div class="container">

        <div class="breadcrumbs">
            Dashboard > <span>Заявки компаний</span>
        </div>

        <div class="top-section">

            <div>

                <h1 class="page-title">
                    Заявки компаний
                </h1>

                <p class="page-description">
                    Управление заявками компаний на практикантов.
                    Просматривайте требования, направления и количество необходимых студентов.
                </p>

            </div>

            <div class="search-counter">

                <div class="counter-label">
                    Всего заявок
                </div>

                <div class="counter-value">
                    {{ $requests->total() }}
                </div>

            </div>

        </div>

        <div class="requests-grid">

            @foreach($requests as $request)

                <div class="request-card">

                    <div class="request-header">

                        <div>

                            <div class="company-name">
                                {{ $request->company->name ?? 'Компания' }}
                            </div>

                            <div class="request-date">
                                {{ $request->created_at->format('d.m.Y') }}
                            </div>

                        </div>

                        <div class="request-badge">
                            #{{ $request->id }}
                        </div>

                    </div>

                    <div class="request-block">

                        <div class="label">
                            Направление
                        </div>

                        <div class="value">
                            {{ $request->direction->name ?? 'Не указано' }}
                        </div>

                    </div>

                    <div class="request-block">

                        <div class="label">
                            Стажировка
                        </div>

                        <div class="value">
                            {{ $request->internship->title ?? 'Не указано' }}
                        </div>

                    </div>

                    <div class="request-block">

                        <div class="label">
                            Требуется студентов
                        </div>

                        <div class="count">
                            {{ $request->required_count }}
                        </div>

                    </div>

                    <div class="request-block">

                        <div class="label">
                            Требования
                        </div>

                        <p class="requirements">
                            {{ $request->requirements_text }}
                        </p>

                    </div>

                    <div class="card-actions">

                        <a
                            href="{{ route('company-requests.show', $request->id) }}"
                            class="details-button"
                        >
                            Подробнее
                        </a>

                        <form
                            action="{{ route('company-requests.destroy', $request->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button class="delete-button">
                                Удалить
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="pagination-wrapper">
            {{ $requests->links() }}
        </div>

    </div>

</main>

<footer>

    <div class="container footer-container">

        <div>

            <h3>Практикум</h3>

            <p>
                © 2026 Практикум.
                Платформа для управления стажировками и практиками.
            </p>

        </div>

        <div class="footer-columns">

            <div>

                <h3>Платформа</h3>

                <a href="#">О платформе</a>
                <a href="#">Компании</a>
                <a href="#">Контакты</a>

            </div>

            <div>

                <h3>Помощь</h3>

                <a href="#">Поддержка</a>
                <a href="#">Политика</a>

            </div>

        </div>

    </div>

</footer>

</body>
</html>

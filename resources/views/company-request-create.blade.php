<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Создание заявки</title>

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
            Dashboard >
            <a href="{{ route('company-requests.index') }}">
                Заявки компаний
            </a>
            >
            <span>Создание</span>
        </div>

        <div class="top-section">

            <div>

                <h1 class="page-title">
                    Создание заявки
                </h1>

                <p class="page-description">
                    Создайте новую заявку на практикантов.
                    Укажите направление, стажировку, количество студентов и требования.
                </p>

            </div>

        </div>

        @if ($errors->any())

            <div class="request-card" style="margin-bottom: 24px; border-color: rgba(255,77,77,0.2);">

                <div class="label" style="color: var(--danger); margin-bottom: 12px;">
                    Ошибки формы
                </div>

                <ul style="padding-left: 18px; color: var(--danger); line-height: 1.8;">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form
            action="{{ route('company-requests.store') }}"
            method="POST"
            class="request-card"
        >
            @csrf

            <div class="request-block">

                <div class="label">
                    Направление
                </div>

                <select
                    name="direction_id"
                    class="input"
                    required
                >

                    @foreach($directions as $direction)

                        <option value="{{ $direction->id }}">
                            {{ $direction->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="request-block">

                <div class="label">
                    Стажировка
                </div>

                <select
                    name="internship_id"
                    class="input"
                    required
                >

                    @foreach($internships as $internship)

                        <option value="{{ $internship->id }}">
                            {{ $internship->description}}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="request-block">

                <div class="label">
                    Количество студентов
                </div>

                <input
                    type="number"
                    name="required_count"
                    class="input"
                    min="1"
                    required
                >

            </div>

            <div class="request-block">

                <div class="label">
                    Требования
                </div>

                <textarea
                    name="requirements_text"
                    class="textarea"
                    rows="6"
                    required
                ></textarea>

            </div>

            <div class="card-actions">

                <button class="details-button">
                    Создать заявку
                </button>

                <a
                    href="{{ route('company-requests.index') }}"
                    class="delete-button"
                    style="
                        text-decoration: none;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    "
                >
                    Отмена
                </a>

            </div>

        </form>

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

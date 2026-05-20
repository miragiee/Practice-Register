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

    <title>CRUD Университеты</title>

    @vite(['resources/js/app.js', 'resources/css/admin.css'])

</head>
<body>

<div class="container">

    <div class="header">

        <h1>CRUD Университеты</h1>

        <p>
            Управление университетами платформы
        </p>

        <a
            href="{{ route('admin') }}"
            class="back-btn"
        >
            ← Назад в админ панель
        </a>

    </div>

    @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if(session('warning'))

        <div class="alert-warning">
            {{ session('warning') }}
        </div>

    @endif

    <h2 class="section-title">
        Вывод информации
    </h2>

    <div
        class="data-panel"
        id="universities-list"
    >
        Загрузка университетов...
    </div>

    <h2 class="section-title">
        Добавление данных
    </h2>

    <div class="form-panel">

        <form
            action="/universities"
            method="POST"
        >

            @csrf

            <p>

                <label for="name">
                    Название
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                >

            </p>

            <p>

                <label for="city">
                    Город
                </label>

                <input
                    type="text"
                    id="city"
                    name="city"
                    required
                >

            </p>

            <p>

                <label for="contact_info">
                    Почта
                </label>

                <input
                    type="text"
                    id="contact_info"
                    name="contact_info"
                    required
                >

            </p>

            <button type="submit">
                Добавить университет
            </button>

        </form>

    </div>

    <h2 class="section-title">
        Обновление данных
    </h2>

    <div class="form-panel">

        <form
            id="update-univ-form"
            method="POST"
        >

            @csrf
            @method('PUT')

            <p>

                <label for="update-univ-select">
                    Выберите университет
                </label>

                <select
                    id="update-univ-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($universities as $univ)

                        <option value="{{ $univ->id }}">
                            {{ $univ->name }}
                        </option>

                    @endforeach

                </select>

            </p>

            <p>

                <label for="update-name">
                    Новое название
                </label>

                <input
                    type="text"
                    id="update-name"
                    name="name"
                >

            </p>

            <p>

                <label for="update-city">
                    Новый город
                </label>

                <input
                    type="text"
                    id="update-city"
                    name="city"
                >

            </p>

            <p>

                <label for="update-contact">
                    Новая почта
                </label>

                <input
                    type="text"
                    id="update-contact"
                    name="contact_info"
                >

            </p>

            <button type="submit">
                Обновить данные
            </button>

        </form>

    </div>

    <h2 class="section-title">
        Удаление данных
    </h2>

    <div class="form-panel">

        <form
            id="delete-univ-form"
            method="POST"
        >

            @csrf
            @method('DELETE')

            <p>

                <label for="delete-univ-select">
                    Выберите университет
                </label>

                <select
                    id="delete-univ-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($universities as $univ)

                        <option value="{{ $univ->id }}">
                            {{ $univ->name }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить выбранный университет
            </button>

        </form>

    </div>

</div>

</body>
</html>

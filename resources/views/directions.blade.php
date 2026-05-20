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

    <title>CRUD Направления</title>

    @vite(['resources/js/app.js', 'resources/css/admin.css'])

</head>
<body>

<div class="container">

    <div class="header">

        <h1>CRUD Направления</h1>

        <p>
            Управление направлениями платформы
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
        id="directions-list"
    >
        Загрузка направлений...
    </div>

    <h2 class="section-title">
        Добавление данных
    </h2>

    <div class="form-panel">

        <form
            action="/directions"
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

                <label for="description">
                    Описание
                </label>

                <input
                    type="text"
                    id="description"
                    name="description"
                    required
                >

            </p>

            <button type="submit">
                Добавить направление
            </button>

        </form>

    </div>

    <h2 class="section-title">
        Обновление данных
    </h2>

    <div class="form-panel">

        <form
            id="update-form"
            method="POST"
        >

            @csrf
            @method('PUT')

            <p>

                <label for="update-direction-select">
                    Выберите направление
                </label>

                <select
                    name="direction_id"
                    id="update-direction-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($directions as $direction)

                        <option value="{{ $direction->id }}">
                            {{ $direction->name }}
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

                <label for="update-description">
                    Новое описание
                </label>

                <input
                    type="text"
                    id="update-description"
                    name="description"
                >

            </p>

            <button type="submit">
                Обновить направление
            </button>

        </form>

    </div>

    <h2 class="section-title">
        Удаление данных
    </h2>

    <div class="form-panel">

        <form
            id="delete-form"
            method="POST"
        >

            @csrf
            @method('DELETE')

            <p>

                <label for="delete-direction-select">
                    Выберите направление
                </label>

                <select
                    name="direction_id"
                    id="delete-direction-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($directions as $direction)

                        <option value="{{ $direction->id }}">
                            {{ $direction->name }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить направление
            </button>

        </form>

    </div>

</div>

</body>
</html>

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

    <title>CRUD Стажировки</title>

    @vite(['resources/js/app.js', 'resources/css/admin.css'])

</head>
<body>

<div class="container">

    <div class="header">

        <h1>CRUD Стажировки</h1>

        <p>
            Управление стажировками платформы
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

    @if ($errors->any())

        <div class="alert-error">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <h2 class="section-title">
        Вывод информации
    </h2>

    <div
        class="data-panel"
        id="internships-list"
    >
        Загрузка стажировок...
    </div>

    <h2 class="section-title">
        Добавление данных
    </h2>

    <div class="form-panel">

        <form
            action="{{ route('internships.store') }}"
            method="POST"
        >

            @csrf

            <p>

                <label for="university_id">
                    University ID
                </label>

                <input
                    type="number"
                    id="university_id"
                    name="university_id"
                    required
                >

            </p>

            <p>

                <label for="direction_id">
                    ID направления
                </label>

                <input
                    type="number"
                    id="direction_id"
                    name="direction_id"
                >

            </p>

            <p>

                <label for="start_date">
                    Дата начала
                </label>

                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    required
                >

            </p>

            <p>

                <label for="end_date">
                    Дата окончания
                </label>

                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    required
                >

            </p>

            <p>

                <label for="capacity">
                    Вместимость
                </label>

                <input
                    type="number"
                    id="capacity"
                    name="capacity"
                    min="0"
                    value="0"
                >

            </p>

            <p>

                <label for="qualities">
                    Качества (JSON или через запятую)
                </label>

                <textarea
                    id="qualities"
                    name="qualities"
                    rows="3"
                    placeholder='["PHP","Laravel"]'
                ></textarea>

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
                Добавить стажировку
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

                <label for="update-internship-select">
                    Выберите стажировку
                </label>

                <select
                    name="internship_id"
                    id="update-internship-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($internships as $internship)

                        <option value="{{ $internship->id }}">
                            ID {{ $internship->id }} | {{ $internship->description }}
                        </option>

                    @endforeach

                </select>

            </p>

            <p>

                <label for="update-university-id">
                    Новый University ID
                </label>

                <input
                    type="number"
                    id="update-university-id"
                    name="university_id"
                >

            </p>

            <p>

                <label for="update-direction-id">
                    Новый ID направления
                </label>

                <input
                    type="number"
                    id="update-direction-id"
                    name="direction_id"
                >

            </p>

            <p>

                <label for="update-start-date">
                    Новая дата начала
                </label>

                <input
                    type="date"
                    id="update-start-date"
                    name="start_date"
                >

            </p>

            <p>

                <label for="update-end-date">
                    Новая дата окончания
                </label>

                <input
                    type="date"
                    id="update-end-date"
                    name="end_date"
                >

            </p>

            <p>

                <label for="update-capacity">
                    Новая вместимость
                </label>

                <input
                    type="number"
                    id="update-capacity"
                    name="capacity"
                    min="0"
                >

            </p>

            <p>

                <label for="update-qualities">
                    Новые качества (JSON или через запятую)
                </label>

                <textarea
                    id="update-qualities"
                    name="qualities"
                    rows="3"
                    placeholder='["PHP","Laravel"]'
                ></textarea>

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
                Обновить данные стажировки
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

                <label for="delete-internship-select">
                    Выберите стажировку
                </label>

                <select
                    name="internship_id"
                    id="delete-internship-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($internships as $internship)

                        <option value="{{ $internship->id }}">
                            ID {{ $internship->id }} | {{ $internship->description }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить стажировку
            </button>

        </form>

    </div>

</div>

</body>
</html>

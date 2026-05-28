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

    <title>CRUD Студенты</title>

    @vite(['resources/js/app.js', 'resources/css/admin.css'])

</head>
<body>

<div class="container">

    <div class="header">

        <h1>CRUD Студенты</h1>

        <p>
            Управление студентами платформы
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
        id="students-list"
    >
        Загрузка студентов...
    </div>

    <h2 class="section-title">
        Добавление данных
    </h2>

    <div class="form-panel">

        <form
            action="/students"
            method="POST"
        >

            @csrf

            <p>

                <label for="full_name">
                    ФИО
                </label>

                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    required
                >

            </p>

            <p>

                <label for="university_id">
                    ID университета
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
                    required
                >

            </p>

            <p>

                <label for="course">
                    Курс
                </label>

                <input
                    type="number"
                    id="course"
                    name="course"
                    required
                >

            </p>

            <p>

                <label for="email">
                    Почта
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    required
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
                    placeholder='["PHP","SQL"]'
                ></textarea>

            </p>

            <button type="submit">
                Добавить студента
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

                <label for="update-student-select">
                    Выберите студента
                </label>

                <select
                    name="student_id"
                    id="update-student-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($students as $student)

                        <option value="{{ $student->id }}">
                            {{ $student->full_name }}
                        </option>

                    @endforeach

                </select>

            </p>

            <p>

                <label for="update-full-name">
                    Новое ФИО
                </label>

                <input
                    type="text"
                    id="update-full-name"
                    name="full_name"
                >

            </p>

            <p>

                <label for="update-university-id">
                    Новый ID университета
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

                <label for="update-course">
                    Новый курс
                </label>

                <input
                    type="number"
                    id="update-course"
                    name="course"
                >

            </p>

            <p>

                <label for="update-email">
                    Новая почта
                </label>

                <input
                    type="email"
                    id="update-email"
                    name="email"
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
                    placeholder='["PHP","SQL"]'
                ></textarea>

            </p>

            <button type="submit">
                Обновить данные студента
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

                <label for="delete-student-select">
                    Выберите студента
                </label>

                <select
                    name="student_id"
                    id="delete-student-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($students as $student)

                        <option value="{{ $student->id }}">
                            {{ $student->full_name }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить выбранного студента
            </button>

        </form>

    </div>

</div>

</body>
</html>

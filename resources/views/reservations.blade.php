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

    <title>CRUD Reservations</title>

    @vite(['resources/js/app.js', 'resources/css/admin.css'])

</head>
<body>

<div class="container">

    <div class="header">

        <h1>CRUD Reservations</h1>

        <p>
            Управление заявками на стажировки
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
        id="reservations-list"
    >
        Загрузка reservations...
    </div>

    <h2 class="section-title">
        Добавление данных
    </h2>

    <div class="form-panel">

        <form
            action="{{ route('reservations.book') }}"
            method="POST"
        >

            @csrf

            <p>

                <label for="company_id">
                    Company ID
                </label>

                <input
                    type="number"
                    id="company_id"
                    name="company_id"
                    required
                >

            </p>

            <p>

                <label for="student_id">
                    Student ID
                </label>

                <input
                    type="number"
                    id="student_id"
                    name="student_id"
                    required
                >

            </p>

            <p>

                <label for="internship_id">
                    Internship ID
                </label>

                <input
                    type="number"
                    id="internship_id"
                    name="internship_id"
                    required
                >

            </p>

            <p>

                <label for="status">
                    Status
                </label>

                <input
                    type="text"
                    id="status"
                    name="status"
                    required
                >

            </p>

            <button type="submit">
                Добавить reservation
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

                <label for="update-reservation-select">
                    Выберите reservation
                </label>

                <select
                    name="reservation_id"
                    id="update-reservation-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($reservations as $reservation)

                        <option value="{{ $reservation->id }}">
                            ID {{ $reservation->id }} | {{ $reservation->status }}
                        </option>

                    @endforeach

                </select>

            </p>

            <p>

                <label for="update-company-id">
                    Новый Company ID
                </label>

                <input
                    type="number"
                    id="update-company-id"
                    name="company_id"
                >

            </p>

            <p>

                <label for="update-student-id">
                    Новый Student ID
                </label>

                <input
                    type="number"
                    id="update-student-id"
                    name="student_id"
                >

            </p>

            <p>

                <label for="update-internship-id">
                    Новый Internship ID
                </label>

                <input
                    type="number"
                    id="update-internship-id"
                    name="internship_id"
                >

            </p>

            <p>

                <label for="update-status">
                    Новый Status
                </label>

                <input
                    type="text"
                    id="update-status"
                    name="status"
                >

            </p>

            <button type="submit">
                Обновить reservation
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

                <label for="delete-reservation-select">
                    Выберите reservation
                </label>

                <select
                    name="reservation_id"
                    id="delete-reservation-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($reservations as $reservation)

                        <option value="{{ $reservation->id }}">
                            ID {{ $reservation->id }} | {{ $reservation->status }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить reservation
            </button>

        </form>

    </div>

</div>

</body>
</html>

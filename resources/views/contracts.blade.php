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

    <title>CRUD Контракты</title>

    @vite(['resources/js/app.js', 'resources/css/admin.css'])

</head>
<body>

<div class="container">

    <div class="header">

        <h1>CRUD Контракты</h1>

        <p>
            Управление контрактами платформы
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
        id="contracts-list"
    >
        Загрузка контрактов...
    </div>

    <h2 class="section-title">
        Добавление контракта
    </h2>

    <div class="form-panel">

        <form
            action="/contracts"
            method="POST"
        >

            @csrf

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

                <label for="company_id">
                    ID компании
                </label>

                <input
                    type="number"
                    id="company_id"
                    name="company_id"
                    required
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

                <label for="status">
                    Статус
                </label>

                <select
                    id="status"
                    name="status"
                >

                    <option value="active">
                        Активен
                    </option>

                    <option value="pending">
                        В ожидании
                    </option>

                    <option value="finished">
                        Завершен
                    </option>

                </select>

            </p>

            <button type="submit">
                Создать контракт
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

                <label for="update-contract-select">
                    Выберите контракт
                </label>

                <select
                    name="contract_id"
                    id="update-contract-select"
                    required
                >

                    <option value="">
                        -- Выберите контракт --
                    </option>

                    @foreach ($contracts as $contract)

                        <option value="{{ $contract->id }}">
                            Контракт №{{ $contract->id }}
                        </option>

                    @endforeach

                </select>

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

                <label for="update-status">
                    Новый статус
                </label>

                <select
                    id="update-status"
                    name="status"
                >

                    <option value="">
                        -- Не менять --
                    </option>

                    <option value="active">
                        Активен
                    </option>

                    <option value="pending">
                        В ожидании
                    </option>

                    <option value="finished">
                        Завершен
                    </option>

                </select>

            </p>

            <button type="submit">
                Обновить данные контракта
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

                <label for="delete-contract-select">
                    Выберите контракт
                </label>

                <select
                    name="contract_id"
                    id="delete-contract-select"
                    required
                >

                    <option value="">
                        -- Выберите ID --
                    </option>

                    @foreach ($contracts as $contract)

                        <option value="{{ $contract->id }}">
                            Контракт №{{ $contract->id }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить выбранный контракт
            </button>

        </form>

    </div>

</div>

</body>
</html>

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

    <title>CRUD компании</title>

    @vite(['resources/js/app.js', 'resources/css/admin.css'])
</head>
<body>

<div class="container">

    <div class="header">

        <h1>CRUD компании</h1>

        <p>
            Управление компаниями платформы
        </p>

        <a
            href="{{ route('admin') }}"
            class="back-btn"
        >
            ← Назад в админ панель
        </a>

    </div>

    {{-- Сообщения --}}
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

    {{-- Вывод информации --}}
    <h2 class="section-title">
        Вывод информации
    </h2>

    <div
        class="data-panel"
        id="companies-list"
    >
        Загрузка компаний...
    </div>

    {{-- Добавление --}}
    <h2 class="section-title">
        Добавление данных
    </h2>

    <div class="form-panel">

        <form
            action="/companies"
            method="POST"
        >
            @csrf

            <p>
                <label for="name">
                    Название компании
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

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    required
                ></textarea>
            </p>

            <p>
                <label for="contact_info">
                    Почта
                </label>

                <input
                    type="email"
                    id="contact_info"
                    name="contact_info"
                    required
                >
            </p>

            <button type="submit">
                Добавить компанию
            </button>

        </form>

    </div>

    {{-- Обновление --}}
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

                <label for="update-company-select">
                    Выберите компанию
                </label>

                <select
                    name="company_id"
                    id="update-company-select"
                    required
                >
                    <option value="">
                        -- Выберите компанию --
                    </option>

                    @foreach ($companies as $company)

                        <option value="{{ $company->id }}">
                            {{ $company->name }}
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

                <textarea
                    id="update-description"
                    name="description"
                    rows="4"
                ></textarea>

            </p>

            <p>

                <label for="update-contact">
                    Новая почта
                </label>

                <input
                    type="email"
                    id="update-contact"
                    name="contact_info"
                >

            </p>

            <button type="submit">
                Обновить данные компании
            </button>

        </form>

    </div>

    {{-- Удаление --}}
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

                <label for="delete-company-select">
                    Выберите компанию
                </label>

                <select
                    name="company_id"
                    id="delete-company-select"
                    required
                >
                    <option value="">
                        -- Выберите компанию --
                    </option>

                    @foreach ($companies as $company)

                        <option value="{{ $company->id }}">
                            {{ $company->name }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить выбранную компанию
            </button>

        </form>

    </div>

</div>

</body>
</html>

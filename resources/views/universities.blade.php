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

        <h1>
            CRUD Университеты
        </h1>

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

    @if($errors->any())

        <div class="alert-warning">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif

    {{-- ====================================================== --}}
    {{-- ВЫВОД --}}
    {{-- ====================================================== --}}

    <h2 class="section-title">
        Список университетов
    </h2>

    <div class="data-panel">

        <table>

            <thead>

            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>ИНН</th>
                <th>Email</th>
                <th>Контактное лицо</th>
                <th>Должность</th>
                <th>Телефон</th>
            </tr>

            </thead>

            <tbody>

            @foreach($universities as $univ)

                <tr>

                    <td>
                        {{ $univ->id }}
                    </td>

                    <td>
                        {{ $univ->name }}
                    </td>

                    <td>
                        {{ $univ->inn }}
                    </td>

                    <td>
                        {{ $univ->user->email }}
                    </td>

                    <td>
                        {{ $univ->contact_person }}
                    </td>

                    <td>
                        {{ $univ->position }}
                    </td>

                    <td>
                        {{ $univ->phone }}
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    {{-- ====================================================== --}}
    {{-- ДОБАВЛЕНИЕ --}}
    {{-- ====================================================== --}}

    <h2 class="section-title">
        Добавление университета
    </h2>

    <div class="form-panel">

        <form
            action="{{ route('universities.store') }}"
            method="POST"
        >

            @csrf

            <p>
                <label>Название ВУЗа</label>

                <input
                    type="text"
                    name="name"
                    required
                >
            </p>

            <p>
                <label>ИНН</label>

                <input
                    type="text"
                    name="inn"
                    required
                >
            </p>

            <p>
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    required
                >
            </p>

            <p>
                <label>Пароль</label>

                <input
                    type="password"
                    name="password"
                    required
                >
            </p>

            <p>
                <label>Контактное лицо</label>

                <input
                    type="text"
                    name="contact_person"
                    required
                >
            </p>

            <p>
                <label>Должность</label>

                <input
                    type="text"
                    name="position"
                    required
                >
            </p>

            <p>
                <label>Телефон</label>

                <input
                    type="text"
                    name="phone"
                    required
                >
            </p>

            <button type="submit">
                Добавить университет
            </button>

        </form>

    </div>

    {{-- ====================================================== --}}
    {{-- ОБНОВЛЕНИЕ --}}
    {{-- ====================================================== --}}

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

                <label>
                    Выберите университет
                </label>

                <select
                    id="update-univ-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach($universities as $univ)

                        <option value="{{ $univ->id }}">
                            {{ $univ->name }}
                        </option>

                    @endforeach

                </select>

            </p>

            <p>
                <label>Название</label>

                <input
                    type="text"
                    name="name"
                >
            </p>

            <p>
                <label>ИНН</label>

                <input
                    type="text"
                    name="inn"
                >
            </p>

            <p>
                <label>Контактное лицо</label>

                <input
                    type="text"
                    name="contact_person"
                >
            </p>

            <p>
                <label>Должность</label>

                <input
                    type="text"
                    name="position"
                >
            </p>

            <p>
                <label>Телефон</label>

                <input
                    type="text"
                    name="phone"
                >
            </p>

            <button type="submit">
                Обновить данные
            </button>

        </form>

    </div>

    {{-- ====================================================== --}}
    {{-- УДАЛЕНИЕ --}}
    {{-- ====================================================== --}}

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

                <label>
                    Выберите университет
                </label>

                <select
                    id="delete-univ-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach($universities as $univ)

                        <option value="{{ $univ->id }}">
                            {{ $univ->name }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить университет
            </button>

        </form>

    </div>

</div>

<script>

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    const updateForm = document.getElementById('update-univ-form');
    const updateSelect = document.getElementById('update-univ-select');

    updateForm.addEventListener('submit', function (e) {

        const id = updateSelect.value;

        updateForm.action = `/universities/${id}`;
    });

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    const deleteForm = document.getElementById('delete-univ-form');
    const deleteSelect = document.getElementById('delete-univ-select');

    deleteForm.addEventListener('submit', function (e) {

        const id = deleteSelect.value;

        deleteForm.action = `/universities/${id}`;
    });

</script>

</body>
</html>

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

    <title>CRUD Документы</title>

    @vite(['resources/js/app.js', 'resources/css/admin.css'])

</head>
<body>

<div class="container">

    <div class="header">

        <h1>CRUD Документы</h1>

        <p>
            Управление документами платформы
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
        id="documents-list"
    >
        Загрузка документов...
    </div>

    <h2 class="section-title">
        Добавление данных
    </h2>

    <div class="form-panel">

        <form
            action="/documents"
            method="POST"
        >

            @csrf

            <p>

                <label for="student_internship_id">
                    Student Internship ID
                </label>

                <input
                    type="number"
                    id="student_internship_id"
                    name="student_internship_id"
                    required
                >

            </p>

            <p>

                <label for="file_path">
                    Путь к файлу
                </label>

                <input
                    type="text"
                    id="file_path"
                    name="file_path"
                    required
                >

            </p>

            <p>

                <label for="type">
                    Тип документа
                </label>

                <input
                    type="text"
                    id="type"
                    name="type"
                    required
                >

            </p>

            <button type="submit">
                Добавить документ
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

                <label for="update-document-select">
                    Выберите документ
                </label>

                <select
                    name="document_id"
                    id="update-document-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($documents as $document)

                        <option value="{{ $document->id }}">
                            ID {{ $document->id }} | {{ $document->type }}
                        </option>

                    @endforeach

                </select>

            </p>

            <p>

                <label for="update-student-internship-id">
                    Новый Student Internship ID
                </label>

                <input
                    type="number"
                    id="update-student-internship-id"
                    name="student_internship_id"
                >

            </p>

            <p>

                <label for="update-file-path">
                    Новый путь к файлу
                </label>

                <input
                    type="text"
                    id="update-file-path"
                    name="file_path"
                >

            </p>

            <p>

                <label for="update-type">
                    Новый тип документа
                </label>

                <input
                    type="text"
                    id="update-type"
                    name="type"
                >

            </p>

            <button type="submit">
                Обновить документ
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

                <label for="delete-document-select">
                    Выберите документ
                </label>

                <select
                    name="document_id"
                    id="delete-document-select"
                    required
                >

                    <option value="">
                        -- Выберите --
                    </option>

                    @foreach ($documents as $document)

                        <option value="{{ $document->id }}">
                            ID {{ $document->id }} | {{ $document->type }}
                        </option>

                    @endforeach

                </select>

            </p>

            <button type="submit">
                Удалить документ
            </button>

        </form>

    </div>

</div>

</body>
</html>

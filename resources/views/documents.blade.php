<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD документов</title>
    @vite(['resources/js/app.js'])
</head>
<body>

    <h1>CRUD документов</h1>

    @if(session('success'))
        <div style="color:green">
            {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div style="color:orange">
            {{ session('warning') }}
        </div>
    @endif

    <h2>Вывод информации</h2>
    <div id="documents-list">Загрузка документов...</div>

    <h2>Добавление данных</h2>
    <form action="/documents" method="POST">
        @csrf
        <p>
            Student Internship ID:
            <input type="number" name="student_internship_id" required>
        </p>
        <p>
            Путь к файлу:
            <input type="text" name="file_path" required>
        </p>
        <p>
            Тип документа:
            <input type="text" name="type" required>
        </p>
        <input type="submit" value="Добавить">
    </form>

    <h2>Обновление данных</h2>
    <form id="update-form" method="POST">
        @csrf
        @method('PUT')
        <p>
            Выберите документ:
            <select name="document_id" id="update-document-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($documents as $document)
                    <option value="{{ $document->id }}">
                        ID {{ $document->id }} | {{ $document->type }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            Новый Student Internship ID:
            <input type="number" name="student_internship_id">
        </p>
        <p>
            Новый путь к файлу:
            <input type="text" name="file_path">
        </p>
        <p>
            Новый тип документа:
            <input type="text" name="type">
        </p>
        <p>
            <button type="submit">
                Обновить данные документа
            </button>
        </p>
    </form>

    <h2>Удаление данных</h2>
    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
        <p>
            Выберите документ:
            <select name="document_id" id="delete-document-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($documents as $document)
                    <option value="{{ $document->id }}">
                        ID {{ $document->id }} | {{ $document->type }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <button type="submit">
                Удалить документ
            </button>
        </p>
    </form>

</body>
</html>

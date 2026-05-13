<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Стажировки студентов</title>
    @vite(['resources/js/app.js'])
</head>
<body>

    <h1>CRUD Стажировки студентов</h1>

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
    <div id="student-internships-list">Загрузка стажировок студентов...</div>

    <h2>Добавление данных</h2>
    <form action="/student-internships" method="POST">
        @csrf
        <p>
            Student ID:
            <input type="number" name="student_id" required>
        </p>
        <p>
            Company ID:
            <input type="number" name="company_id" required>
        </p>
        <p>
            Internship ID:
            <input type="number" name="internship_id" required>
        </p>
        <p>
            Статус:
            <input type="text" name="status" required>
        </p>
        <input type="submit" value="Добавить">
    </form>

    <h2>Обновление данных</h2>
    <form id="update-form" method="POST">
        @csrf
        @method('PUT')
        <p>
            Выберите стажировку студента:
            <select name="student_internship_id" id="update-student-internship-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($studentInternships as $si)
                    <option value="{{ $si->id }}">
                        ID {{ $si->id }} | Студент ID: {{ $si->student_id }} (Статус: {{ $si->status }})
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            Новый Student ID:
            <input type="number" name="student_id">
        </p>
        <p>
            Новый Company ID:
            <input type="number" name="company_id">
        </p>
        <p>
            Новый Internship ID:
            <input type="number" name="internship_id">
        </p>
        <p>
            Новый статус:
            <input type="text" name="status">
        </p>
        <p>
            <button type="submit">
                Обновить данные
            </button>
        </p>
    </form>

    <h2>Удаление данных</h2>
    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
        <p>
            Выберите стажировку студента:
            <select name="student_internship_id" id="delete-student-internship-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($studentInternships as $si)
                    <option value="{{ $si->id }}">
                        ID {{ $si->id }} | Студент ID: {{ $si->student_id }}
                    </option>
                @endforeach
            </select>
        </p>
        <p>
            <button type="submit">
                Удалить запись
            </button>
        </p>
    </form>

</body>
</html>

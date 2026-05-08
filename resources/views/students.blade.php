<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Студенты</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>CRUD студенты</h1>

    {{-- Сообщения об успехе/предупреждениях --}}
    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div style="color:orange">{{ session('warning') }}</div>
    @endif
    @if ($errors->any())
    <div style="color:red">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
@endif

    <h2>Вывод информации</h2>
    <div id="students-list">Загрузка студентов...</div>

    <h2>Добавление данных</h2>
    <form action="/students" method="POST">
        @csrf
        <p>ФИО: <input type="text" name="full_name"></p>
        <p>Айди университета: <input type="number" name="university_id"></p>
        <p>Айди направления: <input type="number" name="direction_id"></p>
        <p>Курс: <input type="number" name="course"></p>
        <p>Почта: <input type="text" name="email"></p>
        <input type="submit" value="Отправить">
    </form>

    <h2>Обновление данных</h2>
    <form id="update-form" method="POST">
        @csrf
        @method('PUT')
        <p>
            Выберите студента:
            <select name="student_id" id="update-student-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                @endforeach
            </select>
        </p>
        <p>ФИО: <input type="text" name="full_name"></p>
        <p>Айди университета: <input type="number" name="university_id"></p>
        <p>Айди направления: <input type="number" name="direction_id"></p>
        <p>Курс: <input type="number" name="course"></p>
        <p>Почта: <input type="text" name="email"></p>
        <p><button type="submit">Обновить данные студента</button></p>
    </form>

    <h2>Удаление данных</h2>
    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
        <p>
            Выберите студента:
            <select name="student_id" id="delete-student-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                @endforeach
            </select>
        </p>
        <p>
            <button type="submit">Удалить выбранного студента</button>
        </p>
    </form>
</body>
</html>
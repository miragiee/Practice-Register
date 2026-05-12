<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD стажировок</title>

    @vite(['resources/js/app.js'])
</head>
<body>

    <h1>CRUD стажировок</h1>

    {{-- Сообщения --}}
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

    <div id="internships-list">

        @foreach ($internships as $internship)
            <div style="border:1px solid black; margin:10px; padding:10px;">
                <p><strong>ID:</strong> {{ $internship->id }}</p>
                <p><strong>University ID:</strong> {{ $internship->university_id }}</p>
                <p><strong>Дата начала:</strong> {{ $internship->start_date }}</p>
                <p><strong>Дата окончания:</strong> {{ $internship->end_date }}</p>
                <p><strong>Описание:</strong> {{ $internship->description }}</p>
            </div>
        @endforeach

    </div>


    <h2>Добавление данных</h2>

    <form action="/internships" method="POST">
        @csrf

        <p>
            University ID:
            <input type="number" name="university_id">
        </p>

        <p>
            Дата начала:
            <input type="date" name="start_date">
        </p>

        <p>
            Дата окончания:
            <input type="date" name="end_date">
        </p>

        <p>
            Описание:
            <input type="text" name="description">
        </p>

        <input type="submit" value="Добавить">
    </form>


    <h2>Обновление данных</h2>

    <form id="update-form" method="POST">
        @csrf
        @method('PUT')

        <p>
            Выберите стажировку:

            <select name="internship_id" id="update-internship-select" required>

                <option value="">-- Выберите --</option>

                @foreach ($internships as $internship)

                    <option value="{{ $internship->id }}">
                        ID {{ $internship->id }} | {{ $internship->description }}
                    </option>

                @endforeach

            </select>
        </p>

        <p>
            Новый University ID:
            <input type="number" name="university_id">
        </p>

        <p>
            Новая дата начала:
            <input type="date" name="start_date">
        </p>

        <p>
            Новая дата окончания:
            <input type="date" name="end_date">
        </p>

        <p>
            Новое описание:
            <input type="text" name="description">
        </p>

        <p>
            <button type="submit">
                Обновить данные стажировки
            </button>
        </p>

    </form>


    <h2>Удаление данных</h2>

    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')

        <p>

            Выберите стажировку:

            <select name="internship_id" id="delete-internship-select" required>

                <option value="">-- Выберите --</option>

                @foreach ($internships as $internship)

                    <option value="{{ $internship->id }}">
                        ID {{ $internship->id }} | {{ $internship->description }}
                    </option>

                @endforeach

            </select>

        </p>

        <p>
            <button type="submit">
                Удалить стажировку
            </button>
        </p>

    </form>

</body>
</html>

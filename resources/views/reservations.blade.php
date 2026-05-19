<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD reservations</title>

    @vite(['resources/js/app.js'])
</head>
<body>

    <h1>CRUD reservations</h1>

    {{-- Сообщения --}}
    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    @if(session('warning'))
        <div style="color:orange">{{ session('warning') }}</div>
    @endif


    <h2>Вывод информации</h2>

    <div id="reservations-list">
        Загрузка reservations...
    </div>


    <h2>Добавление данных</h2>

    <form action="/reservations" method="POST">
        @csrf

        <p>
            Company ID:
            <input type="number" name="company_id">
        </p>

        <p>
            Student ID:
            <input type="number" name="student_id">
        </p>

        <p>
            Internship ID:
            <input type="number" name="internship_id">
        </p>

        <p>
            Status:
            <input type="text" name="status">
        </p>

        <input type="submit" value="Добавить">
    </form>


    <h2>Обновление данных</h2>

    <form id="update-form" method="POST">
        @csrf
        @method('PUT')

        <p>
            Выберите reservation:

            <select name="reservation_id" id="update-reservation-select" required>
                <option value="">-- Выберите --</option>

                @foreach ($reservations as $reservation)
                    <option value="{{ $reservation->id }}">
                        ID {{ $reservation->id }} | {{ $reservation->status }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            Новый Company ID:
            <input type="number" name="company_id">
        </p>

        <p>
            Новый Student ID:
            <input type="number" name="student_id">
        </p>

        <p>
            Новый Internship ID:
            <input type="number" name="internship_id">
        </p>

        <p>
            Новый Status:
            <input type="text" name="status">
        </p>

        <p>
            <button type="submit">
                Обновить reservation
            </button>
        </p>
    </form>


    <h2>Удаление данных</h2>

    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')

        <p>
            Выберите reservation:

            <select name="reservation_id" id="delete-reservation-select" required>
                <option value="">-- Выберите --</option>

                @foreach ($reservations as $reservation)
                    <option value="{{ $reservation->id }}">
                        ID {{ $reservation->id }} | {{ $reservation->status }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <button type="submit">
                Удалить reservation
            </button>
        </p>
    </form>

</body>
</html>

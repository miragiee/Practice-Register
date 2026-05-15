<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Университеты</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>CRUD Университеты</h1>

    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif

    <h2>Вывод информации</h2>
    <div id="universities-list">Загрузка...</div>

    <hr>

    <h2>Добавление данных</h2>
    <form action="/universities" method="POST">
        @csrf
        <p>Название: <input type="text" name="name" required></p>
        <p>Город: <input type="text" name="city" required></p>
        <p>Почта: <input type="text" name="contact_info" required></p>
        <input type="submit" value="Отправить">
    </form>

    <hr>

    <h2>Обновление данных</h2>
    <form id="update-univ-form" method="POST">
        @csrf
        @method('PUT')
        <p>
            Выберите университет:
            <select id="update-univ-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($universities as $univ)
                    <option value="{{ $univ->id }}">{{ $univ->name }}</option>
                @endforeach
            </select>
        </p>
        <p>Новое название: <input type="text" name="name"></p>
        <p>Новый город: <input type="text" name="city"></p>
        <p>Новая почта: <input type="text" name="contact_info"></p>
        <button type="submit">Обновить данные</button>
    </form>

    <hr>

    <h2>Удаление данных</h2>
    <form id="delete-univ-form" method="POST">
        @csrf
        @method('DELETE')
        <p>
            Выберите университет:
            <select id="delete-univ-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($universities as $univ)
                    <option value="{{ $univ->id }}">{{ $univ->name }}</option>
                @endforeach
            </select>
        </p>
        <button type="submit">Удалить выбранный университет</button>
    </form>
</body>
</html>

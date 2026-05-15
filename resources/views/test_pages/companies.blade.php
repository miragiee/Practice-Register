<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD компании</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>CRUD компании</h1>

    {{-- Сообщения об успехе/предупреждениях --}}
    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div style="color:orange">{{ session('warning') }}</div>
    @endif

    <h2>Вывод информации</h2>
    <div id="companies-list">Загрузка компаний...</div>

    <h2>Добавление данных</h2>
    <form action="/companies" method="POST">
        @csrf
        <p>Название: <input type="text" name="name"></p>
        <p>Описание: <input type="text" name="description"></p>
        <p>Почта: <input type="text" name="contact_info"></p>
        <input type="submit" value="Отправить">
    </form>

    <h2>Обновление данных</h2>
    <form id="update-form" method="POST">
        @csrf
        @method('PUT')
        <p>
            Выберите компанию:
            <select name="company_id" id="update-company-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </p>
        <p>Новое название: <input type="text" name="name"></p>
        <p>Новое описание: <input type="text" name="description"></p>
        <p>Новая почта: <input type="text" name="contact_info"></p>
        <p><button type="submit">Обновить данные компании</button></p>
    </form>

    <h2>Удаление данных</h2>
    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
        <p>
            Выберите компанию:
            <select name="company_id" id="delete-company-select" required>
                <option value="">-- Выберите --</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </p>
        <p>
            <button type="submit">Удалить выбранную компанию</button>
        </p>
    </form>
</body>
</html>
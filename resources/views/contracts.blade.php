<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Контракты</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>CRUD Контракты</h1>

    {{-- Сообщения об успехе/предупреждениях --}}
    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div style="color:orange">{{ session('warning') }}</div>
    @endif

    <h2>Вывод информации</h2>
    <div id="contracts-list">Загрузка контрактов...</div>

    <h2>Добавление контракта</h2>
    <form action="/contracts" method="POST">
        @csrf
        <p>ID Университета: <input type="number" name="university_id" required></p>
        <p>ID Компании: <input type="number" name="company_id" required></p>
        <p>Дата начала: <input type="date" name="start_date" required></p>
        <p>Дата окончания: <input type="date" name="end_date" required></p>
        <p>Статус: 
            <select name="status">
                <option value="active">Активен</option>
                <option value="pending">В ожидании</option>
                <option value="finished">Завершен</option>
            </select>
        </p>
        <input type="submit" value="Создать контракт">
    </form>

    <h2>Обновление данных</h2>
    <form id="update-form" method="POST">
        @csrf
        @method('PUT')
        <p>
            Выберите контракт (ID):
            <select name="contract_id" id="update-contract-select" required>
                <option value="">-- Выберите контракт --</option>
                @foreach ($contracts as $contract)
                    <option value="{{ $contract->id }}">Контракт №{{ $contract->id }} (Унив: {{ $contract->university_id }})</option>
                @endforeach
            </select>
        </p>
        <p>Новая дата начала: <input type="date" name="start_date"></p>
        <p>Новая дата окончания: <input type="date" name="end_date"></p>
        <p>Новый статус: 
            <select name="status">
                <option value="">-- Не менять --</option>
                <option value="active">Активен</option>
                <option value="pending">В ожидании</option>
                <option value="finished">Завершен</option>
            </select>
        </p>
        <p><button type="submit">Обновить данные контракта</button></p>
    </form>

    <h2>Удаление данных</h2>
    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
        <p>
            Выберите контракт для удаления:
            <select name="contract_id" id="delete-contract-select" required>
                <option value="">-- Выберите ID --</option>
                @foreach ($contracts as $contract)
                    <option value="{{ $contract->id }}">Удалить контракт №{{ $contract->id }}</option>
                @endforeach
            </select>
        </p>
        <p>
            <button type="submit">Удалить выбранный контракт</button>
        </p>
    </form>

    <script>
        // Скрипт для динамической подстановки ID в Action формы (как в твоем примере подразумевается логикой контроллера)
        document.getElementById('update-contract-select').addEventListener('change', function() {
            document.getElementById('update-form').action = '/contracts/' + this.value;
        });

        document.getElementById('delete-contract-select').addEventListener('change', function() {
            document.getElementById('delete-form').action = '/contracts/' + this.value;
        });
    </script>
</body>
</html>

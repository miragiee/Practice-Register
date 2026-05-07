<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление компаниями</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>Главная страница сайта</h1>

    <h2>Вывод информации</h2>

    <div id="companies-list">Загрузка компаний...</div>

    <h2>Добавление данных</h2>
    <form action="/companies" method="POST">
        @csrf <!-- Обязательно для Laravel -->
        <p>Название: <input type="text" name="name"></p>
        <p>Описание: <input type="text" name="description"></p>
        <p>Почта: <input type="text" name="contact_info"></p>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>

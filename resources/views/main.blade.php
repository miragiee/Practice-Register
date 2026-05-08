<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Хаб</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h2>Сделано</h2>
    <a href="{{ route('companies.index') }}">Перейти к демонстрации CRUD операций с компаниями</a> <br>
    <a href="{{ route('universities.index') }}">Перейти к демонстрации CRUD операций с университетами</a> <br>
    <a href="{{ route('students.index')}}">Перейти к демонстрации CRUD операций со студентами</a> <br>
    <a href="{{ route('directions.index')}}">Перейти к демонстрации CRUD операций с направлениями</a> <br>

    <h2>Не сделано</h2>
    <a href="#">Перейти к демонстрации CRUD операций с практиками</a> <br>
    <a href="#">Перейти к демонстрации CRUD операций с контрактами</a> <br>
    <a href="#">Перейти к демонстрации CRUD операций с документами</a> <br>
    <a href="#">Перейти к демонстрации CRUD операций с бронированием студентов</a> <br>
    <a href="#">Перейти к демонстрации CRUD операций с распределением студентов на практики</a> <br>

</body>
</html>
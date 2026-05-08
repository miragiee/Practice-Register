<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Хаб</title>
    @vite(['resources/js/app.js'])
</head>
<body>

    <a href="{{ route('companies.index') }}">Перейти к демонстрации CRUD операций с компаниями</a> <br>
    <a href="{{ route('universities.index') }}">Перейти к демонстрации CRUD операций с университетами</a> <br>
    <a href="{{ route('students.index')}}">Перейти к демонстрации CRUD операций со студентами</a> <br>

</body>
</html>
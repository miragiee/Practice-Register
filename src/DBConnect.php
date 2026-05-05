<?php
    // Параметры подключения
    $host = 'MySQL-8.4';
    $user = 'root';
    $pass = '';
    $name = 'Practice_Register';

    // Подключение
    $db = mysqli_connect($host, $user, $pass, $name);

    // Проверка соединения
    if (!$db) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Установка кодировки для кириллицы
    mysqli_set_charset($db, "utf8mb4");

    // SQL запрос
    $sql = "SELECT * FROM companies";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC); 
        // MYSQLI_ASSOC сделает ключи массива именами столбцов (id, title и т.д.)
    } else {
        die("Ошибка запроса: " . mysqli_error($db));
    }
?>  
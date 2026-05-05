<?php
// Подключаем настройки БД и файл с функцией
require_once '../src/DBConnect.php';
require_once '../src/GetTableContent.php';

/** @var mysqli $db это надо, чтобы не возникало ошибки в vs code. Без этой строки всё работает*/
$companies = getAllData($db, 'companies');

// Пример вывода данных
foreach ($companies as $company) {
    echo "ID: " . $company['id'] . " - Название: " . $company['name'] . "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Главная страница сайта.</h1>
    
</body>
</html>


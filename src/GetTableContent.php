<?php
function getTableContent($connection, $tableName) {
    // Безопасно оборачиваем имя таблицы в обратные кавычки
    $sql = "SELECT * FROM `$tableName`";
    $query = mysqli_query($connection, $sql);

    if (!$query) {
        return []; // Возвращаем пустой массив в случае ошибки
    }

    return mysqli_fetch_all($query, MYSQLI_ASSOC);
}

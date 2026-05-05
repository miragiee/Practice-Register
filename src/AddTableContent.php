<?php
// Добавление в таблицу компании
// !!! $data ЭТО АССОЦИАТИВНЫЙ МАССИВ !!!
function AddTableContent($connection, $tablename, $data){
    
    $columns = array_keys($data);

    // Здесь мы получаем имена столбцов
    // implode соединяет элементы массива в одну строку. 
    // Сначала в кавычках идёт соединяющий знак, а затем идёт массив
    $columnsStrings = implode("`, `", $columns); 

    // Обеспечение безопасности значений
    $values = array_values($data);
    $safeValues = [];
    foreach ($values as $value){
        $safeValues[] = "'" . mysqli_real_escape_string($connection, $value) . "'";        
    }

    $valuesString = implode(", ", $safeValues);

    $sql = "INSERT INTO `$tablename` (`$columnsStrings`) VALUES ($valuesString)";
    
    $query = mysqli_query($connection, $sql);

}
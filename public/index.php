    <?php
        // Подключаем настройки БД и файл с функцией
        require_once './src/DBConnect.php';
        require_once './src/GetTableContent.php';
        require_once './src/AddTableContent.php';

        global $db;

        $companies = getTableContent($db, 'companies');

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])){
                $newCompany = [
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'contact_info' => $_POST['contact_info']
                ];

                AddTableContent($db, 'companies', $newCompany);
                header("Location: index.php");
                exit;
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../resources/css/app">
    </head>
    <body>
        <h1>Главная страница сайта.</h1>
        <h2>Вывод информации</h2>
        <?php
            // Пример вывода данных
        foreach ($companies as $company) {
            echo "Компания №: " . $company['id'] . " - Название: " . $company['name'] . "<br>";
        }
        ?>

        <h2>Добавление данных</h2>

        <form action="" method="POST">
            <p>Название: <input type="text" name="name"></p>
            <p>Описание: <input type="text" name="description"></p>
            <p>Почта: <input type="text" name="contact_info"></p>
            <input type="submit" name="submit_form" value="Отправить">
        </form>

        <h2>Редактирование данных</h2>

        <h2>Удаление данных</h2>
    </body>
    </html>


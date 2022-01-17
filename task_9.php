<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
        </title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/statistics/chartist/chartist.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    </head>
    <body class="mod-bg-1 mod-nav-link ">
    <?php
    // Создаем объект-соединение с базой данных
    $dbh = new PDO(
        'mysql:host=localhost;dbname=test', 'root', ''
    );

    if(isset($_POST)){
        // Готовим запрос
        $sql = 'INSERT INTO text (msg) VALUES (:msg)';
        $sth = $dbh->prepare($sql);

        // Выполняем запрос:
        $sth->execute([':msg' => $_POST['text']]);
        var_dump($_POST['text']);
    }
    header("refresh: 3; url=task_9.php");

    ?>


    </body>
</html>

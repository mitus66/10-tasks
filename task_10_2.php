<?php
session_start();

    $msg = $_POST['text'];

    // Создаем объект-соединение с базой данных
    $dbh = new PDO(
        'mysql:host=localhost;dbname=test',
        'root',
        ''
    );

    // Готовим запрос
    $sql = 'SELECT * FROM text WHERE msg=:msg';
    $sth = $dbh->prepare($sql);

    // Выполняем запрос:
    $sth->execute(['msg' => $msg]);

    // Получаем данные результата запроса:
    $msg = $sth->fetch(PDO::FETCH_ASSOC);

    $flash = '
        <div class="alert alert-danger fade show" role="alert">
            You should check in on some of those fields below.
        </div>
          ';

    // ищем есть ли среди имеющихся новое сообщение,
    if(!empty($msg)) {
    // если соответствие найдено, вывести флеш-уведомление
        echo $flash;
        $_SESSION['flash'] = $flash;
        header("Location: /task_10.php");
        exit;
    }else{
        if(!empty($_POST['text'])) {
            // Готовим запрос
            $sql = 'INSERT INTO text (msg) VALUES (:msg)';
            $sth = $dbh->prepare($sql);

            // Выполняем запрос:
            $sth->execute([':msg' => $_POST['text']]);
        }
    }

// перенаправить пользователя на стартовую страницу
header("Location: /task_10.php");
<?php
session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Создаем объект-соединение с базой данных
    $dbh = new PDO(
        'mysql:host=localhost;dbname=test',
        'root',
        ''
    );

    // Готовим запрос
    $sql = 'SELECT * FROM users WHERE email=:email';
    $sth = $dbh->prepare($sql);

    // Выполняем запрос:
    $sth->execute(['email' => $email]);

    // Получаем данные результата запроса:
    $email = $sth->fetch(PDO::FETCH_ASSOC);

    $flash = '
        <div class="alert alert-danger fade show" role="alert">
            Такой пользователь уже существует!
        </div>
          ';

    // ищем есть ли среди имеющихся новое сообщение,
    if(!empty($email)) {
        // если соответствие найдено, вывести флеш-уведомление
        $_SESSION['flash'] = $flash;
        echo $flash;
        header("Location: /task_11.php");
        exit;
    }else{
        // Готовим запрос
        $sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';
        $sth = $dbh->prepare($sql);

        // Выполняем запрос:
        $sth->execute(['email' => $_POST['email'], 'password' => $hashed_password]);
    }

// перенаправить пользователя на стартовую страницу
header("Location: /task_11.php");

/*if(password_verify($password, $hashed_password)) {
    // If the password inputs matched the hashed password in the database
    // Do something, you know... log them in.
}

// Else, Redirect them back to the login page.*/
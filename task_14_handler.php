<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];


// Создаем объект-соединение с базой данных
$dbh = new \PDO(
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
$data = $sth->fetch(PDO::FETCH_ASSOC);

// $hashed_password = password_hash($password, PASSWORD_DEFAULT); //нужно для нового пользователя
$login = password_verify($password, $data['password']);

//var_dump($data['password']); die();

if($login) {
    $_SESSION['login'] = $login;
    $flash = '<div class="alert alert-danger fade show" role="alert">Вы зарегистрированы</div>';
    $_SESSION['flash'] = $flash;
}else{
    unset($_SESSION['login']);
    $flash = '<div class="alert alert-danger fade show" role="alert">Неверный логин или пароль</div>';
    $_SESSION['flash'] = $flash;
}
header("Location: /task_14.php");
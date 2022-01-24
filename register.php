<?php
session_start();

// take email and password
$email = $_POST['email'];
$password = $_POST['password'];

// Создаем объект-соединение с базой данных
$dbh = new \PDO(
    'mysql:host=localhost;dbname=test',
    'root',
    ''
);

// 1. ПРОВЕРЯЕМ, ЕСТЬ ЛИ ПОЛЬЗОВАТЕЛЬ С ТАКИМ EMAIL В БД
// Готовим запрос
$sql = 'SELECT * FROM users WHERE email=:email';
$sth = $dbh->prepare($sql);

// Выполняем запрос:
$sth->execute(['email' => $email]);

// Получаем данные результата запроса:
$data = $sth->fetch(PDO::FETCH_ASSOC);

// 2. ЕСЛИ ПОЛЬЗОВАТЕЛЬ НАЙДЕН:
if (!empty($data['email'])) {
    $flash = '<div class="alert alert-danger text-dark" role="alert"><strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.</div>';
}else{
    // иначе,
    // хешируем пароль
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // готовим запрос в БД
    $sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';
    $sth = $dbh->prepare($sql);
    // Выполняем запрос:
    $sth->execute(['email' => $email, 'password' => $hashedPassword]);
//    $sth->bindParam(':emaile', $email);
//    $sth->bindParam(':password', $hashedPassword);
//    $sth->execute();
    // готовим флеш-сообщение
    $flash = '<div class="alert alert-danger fade show" role="alert">Вы зарегистрированы</div>';
}

$_SESSION['flash'] = $flash;
header("Location: /page_register.php");

//$login = password_verify($password, $data['password']);

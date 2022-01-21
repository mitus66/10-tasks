<?php
session_start();

$uploadFileName = time();

if (isset($_FILES['userfile'])
    && 0 == $_FILES['userfile']['error']) {
    $res = move_uploaded_file(
        $_FILES['userfile']['tmp_name'],
        __DIR__ . '/pictures/' . $uploadFileName .'.jpg'
    );
}

// Создаем объект-соединение с базой данных
$dbh = new PDO(
    'mysql:host=localhost;dbname=test',
    'root',
    ''
);
// insert FileName in DB
$sql = 'INSERT INTO images (image) VALUES (:image)';
$sth = $dbh->prepare($sql);
$sth->execute(['image' => $uploadFileName]);

// take FileNames from DB
$sql = 'SELECT * FROM images';
$sth = $dbh->prepare($sql);
$sth->execute();
$images = $sth->fetchAll(PDO::FETCH_ASSOC);

// pass $images in $_SESSION
$_SESSION['images'] = $images;
header("Location: /task_15.php");

<?php
session_start();

if(!isset($_FILES['pictures'])) header("Location: /task_15_1.php");

// Создаем объект-соединение с базой данных
$dbh = new PDO(
    'mysql:host=localhost;dbname=test',
    'root',
    ''
);

// ADD FILES
if (isset($_FILES['userfile'])
    && 0 == $_FILES['userfile']['error']) {
    $uploadFileName = time();
    $res = move_uploaded_file(
        $_FILES['userfile']['tmp_name'],
        __DIR__ . '/pictures/' . $uploadFileName .'.jpg'
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

    header("Location: /task_15_1.php");
}

// DEL FILES
if ((isset($_POST)) and !empty($_POST)) {
    $id = (array_key_first($_POST));
    $imgForDel = array_key_last($_POST);
//    var_dump($_POST);
//    var_dump($id);
//    var_dump($imgForDel);
//    die();

    // delete image from DB
    $sql = 'DELETE FROM images WHERE id=:id';
    $sth = $dbh->prepare($sql);
    $sth->execute(['id' => $id]);
    $sth->fetchAll(PDO::FETCH_ASSOC);

    // delete file drom server
    unlink(dirname(__FILE__). '/pictures/' . $imgForDel . '.jpg');

    // take FileNames from DB
    $sql = 'SELECT * FROM images';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $images = $sth->fetchAll(PDO::FETCH_ASSOC);

    // pass $images in $_SESSION
    $_SESSION['images'] = $images;

    header("Location: /task_15_1.php");
}
//die();



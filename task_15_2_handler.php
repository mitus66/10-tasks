<?php
session_start();

// Создаем объект-соединение с базой данных
$dbh = new PDO(
    'mysql:host=localhost;dbname=test',
    'root',
    ''
);

if(!isset($_FILES['userfile'])) header("Location: /task_15_2.php");

if(isset ($_FILES['userfile']['name'])) {

    $filesQuontity = count($_FILES['userfile']['name']);

    for($key = 0; $key < $filesQuontity; $key++) {

        // Check if file is selected
        if(isset($_FILES['userfile']['name'][$key])
            && $_FILES['userfile']['size'][$key] > 0) {

            $originalFilename = $_FILES['userfile']['name'][$key];

            // Get the fileextension
            $ext = pathinfo($originalFilename, PATHINFO_EXTENSION);

            // Get filename without extesion
            $filenameWithoutExt = basename($originalFilename, '.'.$ext);
            // Generate new filename
            $newFilename = str_replace(' ', '_', $filenameWithoutExt) . '_' . time() . '.' . $ext;
            // Upload the file with new name
            move_uploaded_file($_FILES['userfile']['tmp_name'][$key], __DIR__ . '/pictures/' . $newFilename);
            // add $newFilename in array
//            $newFilename[] = $newFilename;
//            array_push($newFilename[], $newFilename);

            // insert FileName in DB
            $sql = 'INSERT INTO images (image) VALUES (:image)';
            $sth = $dbh->prepare($sql);
            $sth->execute(['image' => $newFilename]);
        }
    }
}

// take FileNames from DB
$sql = 'SELECT * FROM images';
$sth = $dbh->prepare($sql);
$sth->execute();
$images = $sth->fetchAll(PDO::FETCH_ASSOC);
//var_dump($images); die();
// pass $images in $_SESSION
$_SESSION['images'] = $images;

header("Location: /task_15_2.php");


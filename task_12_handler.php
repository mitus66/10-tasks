<?php
session_start();

$msg = $_POST['text'];
var_dump($msg);

$flash = '<div class="alert alert-info fade show" role="alert">'. $msg .'<br></div>';

if (!empty($msg)) {
    echo $flash;
    $_SESSION['flash'] = $flash;
    header("Location: /task_12.php");
    exit;
} else {

}

// перенаправить пользователя на стартовую страницу
header("Location: /task_12.php");

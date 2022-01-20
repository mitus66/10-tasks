<?php
session_start();

function logout()
{
    $logout = $_POST['logout'];

    if($logout)
        unset($_SESSION['login']);
}

logout();

header("Location: /task_14.php");

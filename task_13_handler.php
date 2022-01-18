<?php
session_start();

$count = $_SESSION['count'] ?? 0;
$count++;
$_SESSION['count'] = $count;

header("Location: /task_13.php");
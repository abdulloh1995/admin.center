<?php

session_start();
require_once '../config/db.php';

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];

if ($password) {

    $password = md5($password);

    $sql = "INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES (NULL, '$full_name', '$email', '$password')";
    $stmt2 = $pdoConn->prepare($sql);
    $stmt2->execute();
    $totalRows = $stmt2->rowCount();


    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header('Location: ../index.php');
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../register.php');
}

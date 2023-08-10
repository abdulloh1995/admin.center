<?php

session_start();
require_once '../config/db.php';

$email = $_POST['email'];
$password = md5($_POST['password']);
// $password = $_POST['password'];

$sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
$stmt2 = $pdoConn->prepare($sql);
$stmt2->execute();
$totalRows = $stmt2->rowCount();

if ($totalRows > 0) {
    $user = $stmt2->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user'] = [
        "id" => $user['id'],
        "full_name" => $user['full_name'],
        "email" => $user['email']
    ];

    header('Location: ../students/');
} else {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location: ../index.php');
}
?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>
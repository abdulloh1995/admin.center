<?php
session_start();

if ($_SESSION['user']) {
    header('Location: /students/');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>

    <!-- Форма авторизации -->

    <form action="vendor/signin.php" method="post">
        <label>Email</label>
        <input type="text" name="email" placeholder="Enter your email">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password">
        <button type="submit">Sign in</button>
        <p>
            <a href="/register.php">Sign up</a>!
        </p>
        <?php
        if ($_SESSION['message']) {
            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
        ?>
    </form>

</body>

</html>
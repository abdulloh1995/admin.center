<?php
session_start();
if ($_SESSION['user']) {
    header('Location: profile.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>

    <!-- Форма регистрации -->

    <form action="vendor/signup.php" method="post" enctype="multipart/form-data">
        <label>Name</label>
        <input type="text" name="full_name" placeholder="Enter your name">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password">
        <button type="submit">Submit</button>
        <?php
        if ($_SESSION['message']) {
            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
        ?>
    </form>

</body>

</html>
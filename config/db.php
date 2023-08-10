<?php
$db_username = 'root';
$db_password = '';
$db_name = 'center';
$db_host = 'localhost';

try {
    // Create a new PDO object to establish the connection
    $pdoConn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

    // Set PDO error mode to exception to handle errors
    $pdoConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Connection successful if no exception is thrown

    // echo "Connected to the database successfully!";
} catch (PDOException $e) {
    // Connection failed, display the error message
    echo "Connection failed: " . $e->getMessage();
}

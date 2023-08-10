<?php
include "../config/db.php";
try {
    $id = $_GET["id"];
    $params = [
        'id' => $id
    ];
    $sql = "UPDATE `group` SET `status`=0 WHERE id = :id";



    $stmt = $pdoConn->prepare($sql);
    if ($stmt->execute($params)) {
        $totalRows = $stmt->rowCount();
        header("Location: index.php?msg=Data deleted successfully");
    } else {
        echo "Failed";
    }
} catch (PDOException $e) {
    header("Location: index.php?msgerr=Bazada xatolik bor");
}

<?php
define("LIMIT", 3);

function getPageCount($tableName)
{
    include "config/db.php";
    $sql1 = "SELECT * FROM $tableName";
    $stmt3 = $pdoConn->prepare($sql1);
    $stmt3->execute();
    $totalRows1 = $stmt3->rowCount();
    return ceil($totalRows1 / LIMIT);
}

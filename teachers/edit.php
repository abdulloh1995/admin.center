<?php
include '../config/db.php';

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];




    $params = [
        'id' => $id,
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':phone' => $phone,
        ':address' => $address
    ];

    $sql = "UPDATE `teacher` SET `first_name`=:first_name,`last_name`=:last_name, `phone`=:phone, `address`=:address WHERE id = :id";

    $stmt = $pdoConn->prepare($sql);
    if ($stmt->execute($params)) {
        $totalRows = $stmt->rowCount();
        header("Location: index.php?msg=Data updated successfully");
    } else {
        echo "Failed";
    }
}


// select courses for edit
$sql = "SELECT * FROM teacher WHERE id = $id LIMIT 1";
$stmt2 = $pdoConn->prepare($sql);
$stmt2->execute();
$totalRows = $stmt2->rowCount();
$teacherdata = $stmt2->fetch(PDO::FETCH_ASSOC);


include '../inc/hedaer.php';
?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Edit <?= $teacherdata["last_name"] . ' ' . $teacherdata["first_name"] ?> </h3>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First name:</label>
                    <input type="text" class="form-control" name="first_name" value="<?= $teacherdata["first_name"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">Last name:</label>
                    <input type="text" class="form-control" name="last_name" value="<?= $teacherdata["last_name"] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Phone:</label>
                    <input type="text" class="form-control" name="phone" value="<?= $teacherdata["phone"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">Address:</label>
                    <input type="text" class="form-control" name="address" value="<?= $teacherdata["address"] ?>">
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
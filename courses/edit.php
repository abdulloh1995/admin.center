<?php
include '../config/db.php';

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $course_name = $_POST['course_name'];
    $course_price = $_POST['course_price'];




    $params = [
        'id' => $id,
        ':course_name' => $course_name,
        ':course_price' => $course_price
    ];

    $sql = "UPDATE `course` SET `name`=:course_name,`price`=:course_price WHERE id = :id";

    $stmt = $pdoConn->prepare($sql);
    if ($stmt->execute($params)) {
        $totalRows = $stmt->rowCount();
        header("Location: index.php?msg=Data updated successfully");
    } else {
        echo "Failed";
    }
}


// select courses for edit
$sql = "SELECT * FROM course WHERE id = $id LIMIT 1";
$stmt2 = $pdoConn->prepare($sql);
$stmt2->execute();
$totalRows = $stmt2->rowCount();
$coursedata = $stmt2->fetch(PDO::FETCH_ASSOC);


include '../inc/hedaer.php';
?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Edit <?= $coursedata["name"] ?> course</h3>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Course Name:</label>
                    <input type="text" class="form-control" name="course_name" value="<?= $coursedata["name"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">Course Price:</label>
                    <input type="text" class="form-control" name="course_price" value="<?= $coursedata["price"] ?>">
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
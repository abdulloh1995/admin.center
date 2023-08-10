<?php
include '../config/db.php';

if (isset($_POST["submit"])) {
    // print_r($_POST);
    // die;
    $course_name = $_POST['course_name'];
    $course_price = $_POST['course_price'];

    $params = [
        ':course_name' => $course_name,
        ':course_price' => $course_price
    ];

    $sql = "INSERT INTO `course`(`name`, `price`) VALUES (:course_name, :course_price)";

    $stmt = $pdoConn->prepare($sql);
    if ($stmt->execute($params)) {
        $totalRows = $stmt->rowCount();
        header("Location: index.php?msg=New record created successfully");
    } else {
        echo "Failed";
    }
}

include '../inc/hedaer.php';

?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add New Course</h3>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Course Name:</label>
                    <input type="text" class="form-control" name="course_name" placeholder="php">
                </div>

                <div class="col">
                    <label class="form-label">Course Price:</label>
                    <input type="text" class="form-control" name="course_price" placeholder="1 800 000">
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include '../inc/footer.php'; ?>
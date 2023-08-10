<?php
include '../config/db.php';
include '../inc/hedaer.php';
?>

<div class="container">
    <?php
    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    } elseif (isset($_GET["msgerr"])) {
        $msg = $_GET["msgerr"];
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="text-center mb-4">
        <h3>Courses</h3>
    </div>
    <a href="addCourse.php" class="btn btn-dark mb-3">Add New</a>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Course Name</th>
                <th scope="col">Course Price</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM course";
            $stmt2 = $pdoConn->prepare($sql);
            $stmt2->execute();
            $totalRows = $stmt2->rowCount();
            if ($totalRows > 0) {
                while ($coursedata = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <tr>
                        <td><?php echo $coursedata["id"] ?></td>
                        <td><?php echo $coursedata["name"] ?></td>
                        <td><?php echo $coursedata["price"] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $coursedata["id"] ?>" class="link-warning"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete.php?id=<?php echo $coursedata["id"] ?>" class="link-danger"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <h1>Add Student</h1>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>


<?php include '../inc/footer.php'; ?>
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
        <h3>Groups</h3>
    </div>
    <a href="add.php" class="btn btn-dark mb-3">Add New</a>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Group name</th>
                <th scope="col">Course name</th>
                <th scope="col">Start time</th>
                <th scope="col">End time</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Count students</th>
                <th scope="col">Teacher</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT g.id, g.name group_name, c.name course_name, g.start_time, g.end_time, g.start_date, g.end_date, g.count_student, 
                    CONCAT_WS(' ', t.last_name, t.first_name) teacher
                    FROM `group` g 
                    JOIN course c on c.id = g.course_id
                    JOIN teacher t on t.id = g.teacher_id
                    WHERE g.status = 1;";
            $stmt2 = $pdoConn->prepare($sql);
            $stmt2->execute();
            $totalRows = $stmt2->rowCount();
            if ($totalRows > 0) {
                while ($groupdata = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <tr>
                        <td><?php echo $groupdata["id"] ?></td>
                        <td><?php echo $groupdata["group_name"] ?></td>
                        <td><?php echo $groupdata["course_name"] ?></td>
                        <td><?php echo $groupdata["start_time"] ?></td>
                        <td><?php echo $groupdata["end_time"] ?></td>
                        <td><?php echo $groupdata["start_date"] ?></td>
                        <td><?php echo $groupdata["end_date"] ?></td>
                        <td><?php echo $groupdata["count_student"] ?></td>
                        <td><?php echo $groupdata["teacher"] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $groupdata["id"] ?>" class="link-warning"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete.php?id=<?php echo $groupdata["id"] ?>" class="link-danger"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <h1>Add Group</h1>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>


<?php include '../inc/footer.php'; ?>
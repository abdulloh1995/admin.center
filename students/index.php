<?php
include '../config/db.php';
include '../inc/hedaer.php';

define('LIMIT', '5');


$order = "NULL";
if (isset($_GET['sort']) && !empty($_GET['sort'])) {
    $param = $_GET['sort'];
    $sort_elements = explode(",", $param);
    $sort_column = $sort_elements[0];
    $sort_type = $sort_elements[1];
    $order = 's.' . $sort_column . " " . $sort_type;
    // print_r($order);
    // die;
}

$page = 1;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
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
        <h3>Students</h3>
    </div>
    <a href="add.php" class="btn btn-dark mb-3">Add New</a>

    <table class="table table-hover table-bordered text-center">
        <thead class="table-dark">
            <tr style="font-size: 14px;">
                <th scope="col">ID</th>
                <th>Image</th>
                <th scope="col"> <a href="?sort=first_name,asc">+</a> Full name <a href="?sort=first_name,desc">-</a> </th>
                <th scope="col">Phone</th>
                <th scope="col">email</th>
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
            $offset = ($page - 1) * LIMIT;
            // echo $offset;
            $sql = "SELECT s.id student_id, CONCAT_WS(' ', s.last_name, s.first_name) fullname, s.phone sphone, s.email semail, s.image img,
                    g.id group_id, g.name group_name, c.name course_name, g.start_time, g.end_time, g.start_date, g.end_date, g.count_student, 
                    CONCAT_WS(' ', t.last_name, t.first_name) teacher
                    FROM `student` s
                    JOIN student_group stg on stg.student_id = s.id
                    JOIN `group` g on g.id = stg.group_id 
                    JOIN course c on c.id = g.course_id
                    JOIN teacher t on t.id = g.teacher_id
                    WHERE g.status = 1
                    order by {$order}";
            // echo $sql;
            $stmt2 = $pdoConn->prepare($sql);
            $stmt2->execute();
            $totalRows = $stmt2->rowCount();
            $item = ceil($totalRows / LIMIT);
            // echo $totalRows;
            if ($totalRows > 0) {
                while ($studentdata = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    // echo '<pre>';
                    // print_r($studentdata);
            ?>
                    <tr>
                        <td><?= $studentdata["student_id"] ?></td>
                        <td><img class="w-25" src="./uploads/<?= $studentdata["img"] ?>" class="rounded" alt="..."></td>
                        <td><?= $studentdata["fullname"] ?></td>
                        <td><?= $studentdata["sphone"] ?></td>
                        <td><?= $studentdata["semail"] ?></td>
                        <td><?= $studentdata["group_name"] ?></td>
                        <td><?= $studentdata["course_name"] ?></td>
                        <td><?= $studentdata["start_time"] ?></td>
                        <td><?= $studentdata["end_time"] ?></td>
                        <td><?= $studentdata["start_date"] ?></td>
                        <td><?= $studentdata["end_date"] ?></td>
                        <td><?= $studentdata["count_student"] - $totalRows ?></td>
                        <td><?= $studentdata["teacher"] ?></td>
                        <td>
                            <div class="d-flex flex-column justify-content-between">
                                <a href="edit.php?id=<?= $studentdata["student_id"] ?>" class="link-warning"><i class="fa-solid fa-pen-to-square fs-5"></i></a>
                                <a href="delete.php?id=<?= $studentdata["student_id"] ?>" class="link-danger"><i class="fa-solid fa-trash fs-5"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                die;
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
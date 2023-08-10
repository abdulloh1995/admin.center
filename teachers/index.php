<?php
include '../config/db.php';
include '../inc/hedaer.php';
include '../func.php';

define('LIMIT', '3');

$order = "NULL";
if (isset($_GET['sort']) && !empty($_GET['sort'])) {
    $param = $_GET['sort'];
    $sort_elements = explode(",", $param);
    $sort_column = $sort_elements[0];
    $sort_type = $sort_elements[1];
    $order =  $sort_column . " " . $sort_type;
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
        <h3>Teacher</h3>
    </div>
    <a href="add.php" class="btn btn-dark mb-3">Add New</a>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
                <?php
                $sortparam = $_GET['sort'];
                if (isset($sortparam) && $sortparam == 'id,asc') {
                    $sortparam = 'sort=id,desc';
                    $icon = '<i class="fa-solid fa-arrow-up-a-z"></i>';
                } else {
                    $sortparam = 'sort=id,asc';
                    $icon = '<i class="fa-solid fa-arrow-down-z-a"></i>';
                }
                ?>
                <th scope="col"> <a href="?<?php echo  $sortparam ?>"><?= $icon ?></a> ID
                <th scope="col">First name </th>
                <th scope="col">Last name</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $offset = ($page - 1) * LIMIT;
            $sql = "SELECT * FROM teacher order by {$order} limit $offset," . LIMIT;
            $stmt2 = $pdoConn->prepare($sql);
            $stmt2->execute();
            $totalRows = $stmt2->rowCount();
            if ($totalRows > 0) {
                while ($teacherdata = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <tr>
                        <td><?php echo $teacherdata["id"] ?></td>
                        <td><?php echo $teacherdata["first_name"] ?></td>
                        <td><?php echo $teacherdata["last_name"] ?></td>
                        <td><?php echo $teacherdata["phone"] ?></td>
                        <td><?php echo $teacherdata["address"] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $teacherdata["id"] ?>" class="link-warning"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete.php?id=<?php echo $teacherdata["id"] ?>" class="link-danger"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <h1>Add Teacher</h1>
            <?php
            }
            ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php

            for ($i = 1; $i <= getPageCount('teacher'); $i++) {
                echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }
            ?>

            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>


<?php include '../inc/footer.php'; ?>
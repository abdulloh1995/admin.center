<?php
include '../config/db.php';
try {
    if (isset($_POST["submit"])) {
        // print_r($_POST);
        // die;
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $group_id = $_POST['group_id'];

        $params = [
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':phone' => $phone,
            ':email' => $email,
            ':group_id' => $group_id
        ];
        $sql = "";
        $sql .= "INSERT INTO `student`(`first_name`, `last_name`, `phone`, `email`) 
                VALUES (:first_name, :last_name, :phone, :email);";
        $sql .= "SET @studentid = LAST_INSERT_ID();";
        $sql .= "INSERT INTO `student_group`(`student_id`, `group_id`) 
                VALUES (@studentid, :group_id);";
        // echo '<pre>';
        // print_r($params);
        // echo $sql;
        // die;
        $stmt = $pdoConn->prepare($sql);
        if ($stmt->execute($params)) {
            $totalRows = $stmt->rowCount();
            header("Location: index.php?msg=New record created successfully");
        } else {
            echo "Failed";
        }
    }
} catch (PDOException $e) {
    header("Location: index.php?msgerr=Bazada xatolik bor");
}

include '../inc/hedaer.php';

?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add Student</h3>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First name:</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Sanjar">
                </div>

                <div class="col">
                    <label class="form-label">Last name:</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Rasulov">
                </div>


            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="998907700777">
                </div>

                <div class="col">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="example@gmail.com">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <?php
                    $courselist = '';
                    $sql = "SELECT id group_id, name FROM `group`";
                    // echo $sql;
                    $stmt2 = $pdoConn->prepare($sql);
                    $stmt2->execute();
                    $totalRows = $stmt2->rowCount();
                    if ($totalRows > 0) {
                        while ($coursedata = $stmt2->fetch()) {
                            $courselist .= '<option value="' . $coursedata['group_id'] . '" name="' . $coursedata['group_id'] . '">' . $coursedata['name'] . '</option>';
                        }
                    }
                    ?>
                    <label class="form-label">Select Group:</label>
                    <select class="form-select" aria-label="Default select example" name="group_id">
                        <?= $courselist ?>
                    </select>
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
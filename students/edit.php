<?php
include '../config/db.php';

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $group_name = $_POST['group_name'];
    $course_id = $_POST['course_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $count_student = $_POST['count_student'];
    $teacher_id = $_POST['teacher_id'];




    $params = [
        ':id' => $id,
        ':group_name' => $group_name,
        ':course_id' => $course_id,
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':start_time' => $start_time,
        ':end_time' => $end_time,
        ':count_student' => $count_student,
        ':teacher_id' => $teacher_id
    ];


    $sql = "UPDATE `group` SET `name`=:group_name,`course_id`=:course_id, `start_date`=:start_date, `end_date`=:end_date, `start_time`=:start_time, `end_time`=:end_time, `count_student`=:count_student, `teacher_id`=:teacher_id WHERE id = :id";

    $stmt = $pdoConn->prepare($sql);
    if ($stmt->execute($params)) {
        $totalRows = $stmt->rowCount();
        header("Location: index.php?msg=Data updated successfully");
    } else {
        echo "Failed";
    }
}


// select courses for edit
$sql = "SELECT * FROM `student` WHERE id = $id";
// echo $sql;
// die;
$stmt2 = $pdoConn->prepare($sql);
$stmt2->execute();
$totalRows = $stmt2->rowCount();
$groupdata = $stmt2->fetch(PDO::FETCH_ASSOC);


include '../inc/hedaer.php';
?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Edit <?= $groupdata["name"] ?> group</h3>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Group name:</label>
                    <input type="text" class="form-control" name="group_name" value="<?= $groupdata["name"] ?>">
                </div>

                <div class="col">
                    <?php
                    $courselist = '';
                    $sql = "SELECT id course_id, name FROM course";
                    // echo $sql;
                    $stmt2 = $pdoConn->prepare($sql);
                    $stmt2->execute();
                    $totalRows = $stmt2->rowCount();
                    if ($totalRows > 0) {
                        while ($coursedata = $stmt2->fetch()) {
                            $courselist .= '<option value="' . $coursedata['course_id'] . '" name="' . $coursedata['course_id'] . '">' . $coursedata['name'] . '</option>';
                        }
                    }
                    ?>
                    <label class="form-label">Select Course:</label>
                    <select class="form-select" aria-label="Default select example" name="course_id">
                        <?= $courselist ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Start date</label>
                    <input type="date" class="form-control" name="start_date" value="<?= $groupdata["start_date"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">End date</label>
                    <input type="date" class="form-control" name="end_date" value="<?= $groupdata["end_date"] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Start time</label>
                    <input type="time" class="form-control" name="start_time" value="<?= $groupdata["start_time"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">End time</label>
                    <input type="time" class="form-control" name="end_time" value="<?= $groupdata["end_time"] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Count students</label>
                    <input type="text" class="form-control" name="count_student" value="<?= $groupdata["count_student"] ?>">
                </div>

                <div class="col">
                    <?php
                    $courselist = '';
                    $sql = "SELECT id teacher_id, CONCAT_WS(' ', last_name, first_name) fullname FROM teacher";
                    // echo $sql;
                    $stmt2 = $pdoConn->prepare($sql);
                    $stmt2->execute();
                    $totalRows = $stmt2->rowCount();
                    if ($totalRows > 0) {
                        while ($teacherdata = $stmt2->fetch()) {
                            $courselist .= '<option value="' . $teacherdata['teacher_id'] . '" name="' . $teacherdata['teacher_id'] . '">' . $teacherdata['fullname'] . '</option>';
                        }
                    }
                    ?>
                    <label class="form-label">Select Teacher:</label>
                    <select class="form-select" aria-label="Default select example" name="teacher_id">
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
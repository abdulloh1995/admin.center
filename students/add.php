<?php

include '../config/db.php';
include '../inc/hedaer.php';

?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add Student</h3>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="upload.php" method="post" style="width:50vw; min-width:300px;" enctype="multipart/form-data">
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

            <div class="mb-3">
                <label for="image" class="form-label">Rasim</label>
                <input class="form-control" name="image" type="file" id="image">
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
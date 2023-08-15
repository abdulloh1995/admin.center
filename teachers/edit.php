<?php
include '../config/db.php';

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    // print_r($_FILES['image']['name']);
    // die;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $upload_folder = "uploads/";
    if (isset($_FILES['image'])) {

        if (!is_dir($upload_folder))
            mkdir($upload_folder);

        $errors = array();
        $file_name = $_FILES['image']['name'];

        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_format_arr = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($file_format_arr));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Fayl formati JPEG yoki PNG bo`lishi kerak.";
        }

        // if ($file_size > 2097152) {
        //     $errors[] = 'File hajmi 2 MB dan katta bo`lmasligi kerak';
        // }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, $upload_folder . $file_name);
            // echo "Yuklandi";
        } else {
            print_r($errors);
        }
    }
    $sqlcheck = "SELECT image FROM teacher where id = $id";
    $stmt2 = $pdoConn->prepare($sqlcheck);
    $stmt2->execute();
    $totalRows = $stmt2->rowCount();
    if ($totalRows > 0) {
        $teacherdata = $stmt2->fetch(PDO::FETCH_ASSOC);
        if (empty($file_name)) {
            $file_name = $teacherdata['image'];
        }
    }


    // print_r($file_name);


    $params = [
        'id' => $id,
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':phone' => $phone,
        ':address' => $address,
        ':image' => $file_name
    ];



    $sql = "UPDATE `teacher` SET `first_name`=:first_name,`last_name`=:last_name, `phone`=:phone, `address`=:address, `image`=:image WHERE id = :id";
    // print_r($params);
    // print_r($sql);
    // die;
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
        <form action="" method="post" style="width:50vw; min-width:300px;" enctype="multipart/form-data">
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
                <div class="mb-3">
                    <label for="image" class="form-label">Rasim</label>
                    <input class="form-control" name="image" type="file" id="image">
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
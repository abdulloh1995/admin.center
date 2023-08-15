<?php
include '../config/db.php';
try {
    if (isset($_POST["submit"])) {
        $sql = "";
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
            ':group_id' => $group_id,
            ':image' => $file_name
        ];

        $sql .= "INSERT INTO `student`(`first_name`, `last_name`, `phone`, `email`, `image`) 
                VALUES (:first_name, :last_name, :phone, :email, :image);";
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

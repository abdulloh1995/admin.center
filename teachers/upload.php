<?php
include '../config/db.php';
try {
    if (isset($_POST["submit"])) {
        $sql = "";
        $upload_folder = "uploads/";
        $thumb_upload_folder = "uploads/thumb/";


        if (isset($_FILES['image'])) {

            if (!is_dir($upload_folder))
                mkdir($upload_folder);

            if (!is_dir($thumb_upload_folder))
                mkdir($thumb_upload_folder);



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
                list($width, $height) = getimagesize('./uploads/' . $file_name);
                $percent = 0.5;
                $nwidth = $width * $percent;
                $nheight = $height * $percent;
                $newimage = imagecreatetruecolor($nwidth, $nheight);
                $source = imagecreatefromjpeg('./uploads/' . $file_name);
                imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
                $img_name = $file_name;
                imagejpeg($newimage, $thumb_upload_folder . $img_name);
                // print_r($width,);
                // die;
                // echo "Yuklandi";
            } else {
                print_r($errors);
            }
        }
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $params = [
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':phone' => $phone,
            ':address' => $address,
            ':image' => $file_name
        ];

        $sql = "INSERT INTO `teacher`(`first_name`, `last_name`, `phone`, `address`, `image`) VALUES (:first_name, :last_name, :phone, :address, :image)";

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

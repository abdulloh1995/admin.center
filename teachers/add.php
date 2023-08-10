<?php
include '../config/db.php';
try {
    if (isset($_POST["submit"])) {
        // print_r($_POST);
        // die;
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $params = [
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':phone' => $phone,
            ':address' => $address
        ];

        $sql = "INSERT INTO `teacher`(`first_name`, `last_name`, `phone`, `address`) VALUES (:first_name, :last_name, :phone, :address)";

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
        <h3>Add Teacher</h3>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First name:</label>
                    <input type="text" class="form-control" name="first_name" placeholder="John">
                </div>

                <div class="col">
                    <label class="form-label">Last name:</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Murphy">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Phone number</label>
                    <input type="text" class="form-control" name="phone" placeholder="998970077717">
                </div>

                <div class="col">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Tashkent city">
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
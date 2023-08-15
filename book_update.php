<?php

include './config/db.php';
include './inc/hedaer.php';
try {
    $id = $_GET["id"];
    if (isset($_POST["submit"])) {

        $book_name = $_POST['book_name'];
        $book_price = $_POST['book_price'];
        $model = $_POST['model'];
        $is_yes = $_POST['is_yes'];
        $is_no = $_POST['is_no'];

        $characteristics = [
            "isbm" => $_POST['isbm'],
            "author" => $_POST['author'],
            "language" => $_POST['language'],
            "inscription" => $_POST['inscription'],
            "translator" => $_POST['translator'],
            "number_of_pages" => $_POST['number_of_pages'],
            "publishing_house" => $_POST['publishing_house'],
            "cover_type" => $_POST['cover_type'],
            "paper_format" => $_POST['paper_format'],
            "date_of_publishied" => $_POST['date_of_publishied']
        ];

        if (isset($is_yes) && !empty($is_yes)) {
            $is_available = 1;
        } else {
            $is_available = 0;
        }

        $tojson = json_encode($characteristics);
        // echo '<pre>';
        // print_r($_POST);
        // echo '<br>';
        // print_r($tojson);
        // die;


        $sql = "";
        $sql = "UPDATE `book` SET `book_name`='$book_name',`book_price`=$book_price, `model`=$model, `is_available`=$is_available, `characteristics`=$characteristics WHERE id = $id";
        // echo '<pre>';
        // print_r($params);
        // echo $sql;
        // die;
        $stmt = $pdoConn->prepare($sql);
        if ($stmt->execute()) {
            $totalRows = $stmt->rowCount();
            header("Location: prod.php?msg=New record created successfully");
        } else {
            echo "Failed";
        }
    }
} catch (PDOException $e) {
    header("Location: index.php?msgerr=Bazada xatolik bor");
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
        <h3>Add Book</h3>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Book name</label>
                    <input type="text" class="form-control" name="book_name">
                </div>

                <div class="col">
                    <label class="form-label">Book price:</label>
                    <input type="text" class="form-control" name="book_price">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Model</label>
                    <input type="text" class="form-control" name="model">
                </div>

                <div class="col">
                    <label class="form-label">Is available?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="is_yes" id="is_yes" checked>
                        <label class="form-check-label" for="is_yes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="is_no" id="is_no">
                        <label class="form-check-label" for="is_no">
                            No
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <h5>Characteristics</h5>
            </div>
            <hr class="border border-primary border-3 opacity-75">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">ISBN</label>
                    <input type="text" class="form-control" name="isbm">
                </div>

                <div class="col">
                    <label class="form-label">Автор</label>
                    <input type="text" class="form-control" name="author">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Язык</label>
                    <input type="text" class="form-control" name="language">
                </div>

                <div class="col">
                    <label class="form-label">Надпись</label>
                    <input type="text" class="form-control" name="inscription">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Переводчик</label>
                    <input type="text" class="form-control" name="translator">
                </div>

                <div class="col">
                    <label class="form-label">Количество страниц</label>
                    <input type="text" class="form-control" name="number_of_pages">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Издательство</label>
                    <input type="text" class="form-control" name="publishing_house">
                </div>

                <div class="col">
                    <label class="form-label">Тип обложки</label>
                    <input type="text" class="form-control" name="cover_type">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Формат бумаги</label>
                    <input type="text" class="form-control" name="paper_format">
                </div>

                <div class="col">
                    <label class="form-label">Год издания</label>
                    <input type="text" class="form-control" name="date_of_publishied">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>




<?php include './inc/footer.php'; ?>
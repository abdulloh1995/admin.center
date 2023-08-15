<?php
include '../config/db.php';
include '../inc/hedaer.php';

?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add Teacher</h3>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="upload.php" method="post" style="width:50vw; min-width:300px;" enctype="multipart/form-data">
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

<?php include '../inc/footer.php'; ?>
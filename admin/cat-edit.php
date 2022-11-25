<?php
include './config/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <h1 class="text-center">Edit Category</h1>
    <div class="container">
        <a href="./cat-list.php" class="btn btn-dark back">Back</a>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 ">

                <?php
                include('./config/config.php');
                $id = $_GET['id'];
                $sql = "SELECT * FROM categories WHERE id=$id";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);

                ?>
                <form action="./cat-update.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />

                    <div class="mb-3">
                        <label for="catname" class="form-label">Category Name</label>
                        <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" id="catname">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Category</button>
                </form>
            </div>

            <div class="col-3"></div>
        </div>
    </div>

</body>

</html>
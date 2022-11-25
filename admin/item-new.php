<?php
include './config/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h1>Item Add </h1>

    <div class="container">
        <a href="./item-list.php" class="btn btn-dark back">Back</a>
        <div class="row">
            <div class="col-3"></div>

            <div class="col-6 ">


                <form action="./item-add.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="title" class="form-label">Item Title</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Item Brand</label>
                        <input type="text" name="brand" class="form-control" id="brand">
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Item Review</label>
                        <textarea name="review" id="review" rows="1" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Item Price</label>
                        <input type="text" name="price" class="form-control" id="price">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Item Category</label>
                        <select name="category_id" class="form-select" id="category">
                            <option selected>Open this select menu</option>
                            <?php
                            include('./config/config.php');
                            $sql = "SELECT * FROM categories";
                            $result =  mysqli_query($conn, $sql);
                            // var_dump(mysqli_fetch_all($result, MYSQLI_ASSOC));
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Item Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Item</button>
                </form>
            </div>

            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>
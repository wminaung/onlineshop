<?php
include('./config/config.php');
$id = $_GET['id'];
//$sql = "SELECT items.*, categories.name FROM items LEFT JOIN categories ON items.category_id=categories.id ORDER BY items.reached_date DESC WHERE items.id=$id";
$sql = "SELECT * FROM items WHERE id=$id";
$result  = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Edit</title>
    <!-- CSS only -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">


</head>

<body>
    <h1>Item Edit</h1>
    <div class="container">
        <a href="./item-list.php" class="btn btn-dark back">Back</a>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 ">


                <form action="./item-update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Item Title</label>
                        <input type="text" value="<?php echo $row['title'] ?>" name="title" class="form-control" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Item Brand</label>
                        <input type="text" value="<?php echo $row['brand'] ?>" name="brand" class="form-control" id="brand">
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Item Review</label>
                        <textarea name="review" id="review" rows="1" class="form-control"><?php echo $row['review'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Item Price</label>
                        <input type="text" value="<?php echo $row['price'] ?>" name="price" class="form-control" id="price">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Item Category</label>
                        <select name="category_id" class="form-select" id="category">
                            <option>Open this select menu</option>
                            <?php
                            include('./config/config.php');
                            $sql = "SELECT * FROM categories";
                            $categories =  mysqli_query($conn, $sql);
                            // var_dump(mysqli_fetch_all($result, MYSQLI_ASSOC));
                            while ($cat_row = mysqli_fetch_assoc($categories)) {

                                if ($cat_row['id'] == $row['category_id']) {

                            ?>
                                    <option value="<?php echo $cat_row['id'] ?>" selected><?php echo $cat_row['name'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $cat_row['id'] ?>"><?php echo $cat_row['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">

                        <label for="photo" class="form-label">Item Photo</label>
                        <img src="./images/<?php echo $row['photo']; ?>" alt="Img" width="40">
                        <input type="file" name="photo" id="photo" class="form-control">

                    </div>

                    <button type="submit" class="btn btn-primary">Update Item</button>
                </form>

            </div>

            <div class="col-3"></div>
        </div>

    </div>
</body>

</html>
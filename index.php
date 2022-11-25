<?php
include("./admin/config/config.php");

$cat_result = mysqli_query($conn, "SELECT * FROM categories");


if (!empty($_GET['id'])) {
    $id =  $_GET['id'];
    $item_result = mysqli_query($conn, "SELECT * FROM items WHERE category_id=$id");
} else {
    $item_result = mysqli_query($conn, "SELECT * FROM items");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnlineShop</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <h1>OnlineShop</h1>
        </div>
        <div class="row">
            <div class="col-2 text-white bg-secondary">
                <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 200px;">
                    <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white link-dark text-decoration-none">
                        <span class="fs-4">All Category</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto ">
                        <?php
                        while ($cat = mysqli_fetch_assoc($cat_result)) {
                        ?>
                            <li class="nav-item">
                                <a href="./index.php?id=<?php echo $cat['id'] ?>" class="nav-link text-white my-nav-link " aria-current="page">
                                    <?php echo $cat['name']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>
                    <hr>

                </div>
            </div>
            <div class="col main d-flex flex-wrap bg-white">
                <?php

                while ($item = mysqli_fetch_assoc($item_result)) {

                ?>
                    <div class="card" style="width: 210px;">
                        <img src="./admin/images/<?php echo $item['photo'] ?>" class="card-img-top" alt="Img">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item['title'] ?></h5>
                            <div>Brand : <i><?php echo $item['brand'] ?></i></div>
                            <div>Price : <i>$<?php echo $item['price'] ?></i></div>
                            <?php
                            $id =  $item['category_id'];
                            $result =  mysqli_query($conn, "SELECT name FROM categories WHERE id=$id");
                            $item_cat = mysqli_fetch_assoc($result);
                            ?>
                            <a href="./item-detail.php?id=<?php echo $item['id'] ?>"><i>detail</i></a>
                            <div><code>Category: <?php echo $item_cat['name']; ?></code></div>
                            <p class="card-text">

                            </p>

                            <a href="./addtocart.php?id=<?php echo $item['id'] ?>" class="btn btn-danger">Add to cart</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="foo p-1 text-end">
                <a href="./view-cart.php" class="text-decoration-none  btn btn-success btn-sm"> <i class="fa fa-shopping-cart text-danger fs-6"></i> View Cart</a>
            </div>
            <div class="footer bg-secondary text-center">
                &copy; . All Right Reserved <?php echo date("Y"); ?>
            </div>
        </div>
    </div>

    <script src="./js/script.js"></script>
</body>

</html>
<?php
include("./admin/config/config.php");
session_start();

$id = $_GET['id'];

$item_result = mysqli_query($conn, "SELECT * FROM items WHERE id=$id");

$item = mysqli_fetch_assoc($item_result);

$fakePrice = $item['price'] * (40 / 100);






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #eee;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <h1>
                Item Detail
            </h1>
        </div>
        <div class="row main">

            <div class="container mt-5 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="images p-3">
                                        <div class="text-center p-4"> <img id="main-image" src="./admin/images/<?php echo $item['photo'] ?>" width="250" /> </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product p-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center "> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">
                                                    <a class="btn btn-light rounded-circle" href="<?php echo "./index.php"; ?>">Back</a>
                                                </span> </div> <i class="fa fa-shopping-cart text-muted"></i>
                                        </div>
                                        <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand"><?php echo $item['brand']; ?></span>
                                            <h5 class="text-uppercase"><?php echo $item['title'] ?></h5>
                                            <div class="price d-flex flex-row align-items-center">
                                                <span class="act-price">$<?php echo $item['price'] ?> &nbsp;</span>
                                                <div class="ml-2">
                                                    <small class="dis-price"> $<?php echo $fakePrice; ?></small> <span>40% OFF</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="about"><?php echo $item['review'] ?></p>
                                        <div class="sizes mt-5">
                                            <h6 class="text-uppercase">Size</h6> <label class="radio"> <input disabled type="radio" name="size" value="S" checked> <span>S</span> </label> <label class="radio"> <input disabled type="radio" name="size" value="M"> <span>M</span> </label> <label class="radio"> <input disabled type="radio" name="size" value="L"> <span>L</span> </label> <label class="radio"> <input disabled type="radio" name="size" value="XL"> <span>XL</span> </label> <label class="radio"> <input disabled type="radio" name="size" value="XXL"> <span>XXL</span> </label>
                                        </div>
                                        <div class="cart mt-4 align-items-center"> <a href="./addtocart.php?id=<?php echo $item['id'] ?>" class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</a> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="foo text-end py-2">
                <a href="./view-cart.php" class="me-3 btn btn-success btn-sm position-relative">
                    <?php
                    if (!empty($_SESSION['cart'])) {
                        $cart_qty = 0;
                        foreach ($_SESSION['cart'] as $key => $value) {
                            $cart_qty += $value;
                        }
                        if ($cart_qty > 99) {
                            $cart_qty = "99+";
                        }

                    ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill deep-red-bg">
                            <?php echo $cart_qty ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>

                    <?php } ?>
                    <i class="fa fa-shopping-cart fs-6 deep-red"></i> View Cart</a>

            </div>
            <div class="footer bg-secondary text-center">
                &copy; . All Right Reserved <?php echo date("Y"); ?>
            </div>
        </div>
    </div>


</body>

</html>
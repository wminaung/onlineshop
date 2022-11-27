<?php
include("./admin/config/config.php");
session_start();

if (empty($_SESSION['cart'])) {
    header("location:./index.php");
    exit();
}


$cart_arry = array();
foreach ($_SESSION['cart'] as $id => $qty) {
    array_push($cart_arry, $id);
}


$cart_id = implode(',', $cart_arry);

$item_result =  mysqli_query($conn, "SELECT * FROM items WHERE id IN ($cart_id)");

$total_price = 0;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Caret</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <style>
        body {
            background: #eee;
        }

        .ui-w-40 {
            width: 40px !important;
            height: auto;
        }

        .card {
            box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        }

        .ui-product-color {
            display: inline-block;
            overflow: hidden;
            margin: .144em;
            width: .875rem;
            height: .875rem;
            border-radius: 10rem;
            -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <h1>Item Detail</h1>
        </div>
        <div class="row main">

            <div class="container px-3 my-5 clearfix">
                <!-- Shopping cart table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Shopping Cart</h2>
                        <div><a href="./clear-cart.php" class="btn btn-danger" onclick="return confirm('Are you sure?')">clear cart</a></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 400px;">Item Name</th>
                                        <th class="text-right py-3 px-4" style="width: 170px;">Unique Price</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                        <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($item = mysqli_fetch_assoc($item_result)) {
                                        $item_id = $item['id'];
                                        $quantity = 0;

                                        foreach ($_SESSION['cart'] as $id => $qty) {
                                            if ($item_id == $id) {
                                                $quantity = $qty;
                                            }
                                        }


                                    ?>
                                        <tr>
                                            <td class="p-4">
                                                <div class="media align-items-center">
                                                    <img src="./admin/images/<?php echo $item['photo'] ?>" class="d-block ui-w-40 ui-bordered mr-4" alt="Item">
                                                    <div class="media-body">
                                                        <span class="d-block text-dark"><?php echo $item['title'] ?></span>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right font-weight-semibold align-middle p-4">
                                                <?php echo $item['price'] ?>
                                            </td>
                                            <td class="text-right font-weight-semibold align-middle p-4"><?php echo $item['price'] ?>
                                            </td>

                                            <td class="align-middle p-4 text-center">
                                                <?php echo $quantity; ?>
                                            </td>
                                            <td class="text-right font-weight-semibold align-middle p-4">
                                                <?php echo $item['price'] * $quantity ?>
                                            </td>
                                            <td class="text-center align-middle px-0"><a href="./remove_cart.php?id=<?php echo $item['id'] ?>" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove"><i class="fa fa-trash fs-4" aria-hidden="true"></i></a></td>
                                        </tr>
                                    <?php
                                        $total_price += $item['price'] * $quantity;
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- / Shopping cart table -->

                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                            <div class="mt-4">
                            </div>
                            <div class="d-flex">
                                <div class="text-right mt-4 mr-5">
                                    <label class="text-muted font-weight-normal m-0"></label>
                                    <div class="text-large"><strong></strong></div>
                                </div>
                                <div class="text-right mt-4">
                                    <label class="text-muted font-weight-normal m-0">Total price</label>
                                    <div class="text-large"><strong>$<?php echo $total_price; ?></strong></div>
                                </div>
                            </div>
                        </div>


                        <div class="float-end col-5">
                            <h5 class="fw-bold">Order Now</h5>
                            <form action="./submit-order.php" method="POST">

                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="name">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="email">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="phone">Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <input type="text" name="phone" id='phone' class="form-control">
                                </div>
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="visa">Visa-Card</label>
                                    <input type="text" name='visa' id='visa' class="form-control">
                                </div>

                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="address">Address&nbsp;&nbsp;&nbsp;</label>
                                    <input type="text" name='address' id='address' class="form-control">
                                </div>

                                <a href="./index.php" type="button" class="btn btn-lg btn-secondary md-btn-flat mt-2 mr-3">
                                    Back to shopping
                                </a>

                                <button type="submit" class="btn btn-lg btn-primary mt-2">Order</button>
                            </form>


                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="foo">
            </div>
            <div class="footer bg-secondary text-center">
                <?php echo date("Y"); ?> &copy; . All Right Reserved
            </div>
        </div>
    </div>


</body>

</html>
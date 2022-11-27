<?php
include './admin/config/config.php';
session_start();

if (empty($_POST) || empty($_SESSION['cart'])) {
    header('location:./404.php');
    exit();
}


foreach ($_POST as $key => $value) {
    if ($value == null || empty($value) || $value == "") {
        $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : './index.php';
        header("location:$url");
        exit();
    }
}



$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$visa = $_POST["visa"];
$address = $_POST["address"];
$received = date('Y-m-d H:m:s', strtotime("+7 days", strtotime('now')));

$sql = "INSERT INTO orders(name, email,phone,visa_card,address,status,ordered_date, received_date) 
        VALUES ('$name', '$email', '$phone', '$visa', '$address', 0,NOW(), '$received') ";
mysqli_query($conn, $sql);

$order_id = mysqli_insert_id($conn);

foreach ($_SESSION['cart'] as $id => $qty) {

    mysqli_query($conn, "INSERT INTO order_items(item_id, order_id, qty) VALUES ($id,$order_id, $qty) ");
}

unset($_SESSION['cart']);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Submitted</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <style>
        html {
            background-color: black;
        }

        body {
            background-color: #fff;
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <h1>Order Submitted</h1>

        </div>
        <div class="row main">

            <div class="container px-3 my-5 clearfix">
                <div class='row '>
                    <div class="col-2"></div>
                    <div class="col-6 ">
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </symbol>
                        </svg>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>
                                Your order is submitted. We will delever the items soon.
                            </div>
                        </div>

                    </div>
                    <div class="col-2 px-3 py-2 "> <a class="btn btn-primary btn-sm" href="./index.php">OnlineShop Home</a></div>
                </div>
                <div class="row">


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
<?php
include("./config/config.php");
include './config/auth.php';

$orders_result = mysqli_query($conn, "SELECT * FROM orders");




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order_list</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <h1> <a href="./cat-list.php" class="btn btn-dark back">Back</a> Order List</h1>

    <div class="container">

        <ul class="row main">

            <?php
            if (!$orders_result->num_rows) {
                echo "<h2>There is no Order.</h2>";
            }
            while ($order = mysqli_fetch_assoc($orders_result)) {


                if ($order['status']) {
            ?>
                    <li class="delivered shadow-lg p-3  bg-body rounded ">

                    <?php
                } else {
                    ?>

                    <li class="shadow-lg py-3 bg-body rounded">
                    <?php } ?>

                    <div class="order">
                        <b><?php echo $order['name'] ?></b>
                        <i><?php echo $order['email'] ?></i>
                        <span><?php echo $order['phone'] ?></span>
                        <span><?php echo $order['visa_card'] ?></span>
                        <p><?php echo $order['address'] ?></p>
                        <p><?php echo $order['received_date'] ?></p>
                        <?php
                        if ($order['status']) {
                        ?>
                            <a href="./order-status.php?id=<?php echo $order['id']; ?>&status=0">Undo</a>
                        <?php
                        } else { ?>
                            <a href="./order-status.php?id=<?php echo $order['id']; ?>&status=1">Mark as delivered</a>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="items">
                        <?php
                        $order_id = $order['id'];
                        $order_item = mysqli_query($conn, "SELECT order_items.*,items.title FROM order_items LEFT JOIN items ON order_items.item_id=items.id WHERE order_items.order_id=$order_id ");

                        while ($item = mysqli_fetch_assoc($order_item)) {
                        ?>


                            <b>
                                <a href="./../item-detail.php?id=<?php echo $item['item_id'] ?>">
                                    <?php echo $item['title'] ?>
                                </a>
                                (<?php echo $item['qty'] ?>)
                            </b>

                        <?php } ?>
                    </div>



                    </li>

                <?php
            }
                ?>
        </ul>

    </div>


</body>

</html>
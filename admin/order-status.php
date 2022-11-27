<?php
include './config/config.php';
include './config/auth.php';

$id = $_GET['id'];

$status = $_GET['status'];

mysqli_query($conn, "UPDATE orders SET status=$status, received_date=now() WHERE id=$id ");

header('location:./orders.php');

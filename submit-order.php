<?php
include './admin/config/config.php';
session_start();

if (empty($_POST)) {
    exit();
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

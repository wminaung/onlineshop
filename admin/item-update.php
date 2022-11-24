<?php
include './config/config.php';
$id = $_POST['id'];

$title = $_POST['title'];
$brand = $_POST['brand'];
$review = $_POST['review'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];
$photo = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];

$expired_date = date('Y-m-d H:i:s', strtotime('+3 month', strtotime('now')));

if ($photo) {
    move_uploaded_file($tmp, "./images/$photo");
    $sql = "UPDATE items SET title='$title', brand='$brand', review='$review', price=$price, category_id=$category_id, photo='$photo', expired_date='$expired_date' WHERE id=$id ";
} else {
    $sql = "UPDATE items SET title='$title', brand='$brand', review='$review', price=$price, category_id=$category_id,  expired_date='$expired_date' WHERE id=$id ";
}

mysqli_query($conn, $sql);

header('location:./item-list.php');

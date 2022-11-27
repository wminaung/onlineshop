<?php

include './config/auth.php';

include('./config/config.php');


foreach ($_POST as $key => $val) {

    if ($val == "" || $val == null || empty($val)) {
        echo "<script>window.alert('You need to enter all value!');window.location.href='./item-new.php'</script>";
        exit();
        break;
    }
}




$title = $_POST['title'];
$brand = $_POST['brand'];
$review = $_POST['review'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];
$photo = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];

$expired_date = date('Y-m-d H:i:s', strtotime("+3 months", strtotime("now")));

if (!is_numeric($price)) {
    echo "<script>window.alert('Price must be number!!');window.location.href='./item-new.php'</script>";
    exit();
}
if (!is_numeric($category_id)) {
    echo "<script>window.alert('Category needed to Choose!!!');window.location.href='./item-new.php'</script>";
    exit();
}




if (!empty($photo)) {
    move_uploaded_file($tmp, "./images/$photo");
} else {
    echo "<script>window.alert('Photo is required!!');window.location.href='./item-new.php'</script>";
    exit();
}



$sql = "INSERT INTO items(title, brand, review, price, photo, category_id,reached_date, expired_date) VALUES ( '$title', '$brand', '$review', $price, '$photo', $category_id, NOW(), '$expired_date' )";

mysqli_query($conn, $sql);

header("location:item-list.php");

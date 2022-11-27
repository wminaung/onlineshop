<?php
include './config/auth.php';

include('./config/config.php');

if (!empty($_POST['name'])) {
    $name = $_POST['name'];


    $sql = "INSERT INTO categories(name, created_date, modified_date) VALUES ('$name',now(), now())";
    mysqli_query($conn, $sql);

    header("location:./cat-list.php");
} else {
    echo "<script>window.alert('Category is Needed to Save!');window.location.href='./cat-new.php'</script>";
}

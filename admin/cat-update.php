<?php

include './config/auth.php';

include "./config/config.php";

$id = $_POST['id'];

if (!empty($_POST['name'])) {
    $name = $_POST['name'];


    $sql = "UPDATE categories SET name='$name', modified_date=NOW() WHERE id=$id";

    mysqli_query($conn, $sql);

    header('location:./cat-list.php');
} else {
    echo "<script>window.alert('Category is Needed to Save!');window.location.href='./cat-edit.php'</script>";
}

<?php

include './config/auth.php';
include "./config/config.php";

$id = $_GET['id'];


$sql = "DELETE from items WHERE id=$id";

mysqli_query($conn, $sql);

header('location:./item-list.php');

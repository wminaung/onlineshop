<?php
include "./config/config.php";

include './config/auth.php';

$id = $_GET["id"];

$sql = "DELETE FROM categories WHERE id=$id";

mysqli_query($conn, $sql);

header("location:cat-list.php");

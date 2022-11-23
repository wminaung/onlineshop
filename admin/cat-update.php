<?php

include "./config/config.php";

$id = $_POST['id'];
$name = $_POST['name'];


$sql = "UPDATE categories SET name='$name', modified_date=NOW() WHERE id=$id";

mysqli_query($conn, $sql);

header('location:cat-list.php');

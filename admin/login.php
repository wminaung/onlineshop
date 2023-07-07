<?php
session_start();
$name = $_POST['name'];
$password = $_POST['password'];

if ($name == "admin" && $password == "admin") {
    $_SESSION['auth'] = true;
    header('location:./item-list.php');
} else {
    header('location:./index.php');
}

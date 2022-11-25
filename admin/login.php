<?php
session_start();
$name = $_POST['name'];
$password = $_POST['password'];

if ($name == "admin" && $password == "12345") {
    $_SESSION['auth'] = true;
    header('location:./item-list.php');
} else {
    header('location:./index.php');
}

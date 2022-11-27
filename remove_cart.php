<?php
session_start();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];


    foreach ($_SESSION['cart'] as $session_id => $qty) {
        if ($id == $session_id) {
            print_r($_SESSION['cart']);
            unset($_SESSION['cart'][$id]);
        }
    }
}



$prev_url = $_SERVER['HTTP_REFERER'];
header("location:$prev_url");

////////
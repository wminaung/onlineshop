<?php
session_start();

if (!empty($_GET['id'])) {
    $id = (int)$_GET['id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array($id);
    } else {
        $cart_ary = $_SESSION['cart'];
        array_push($cart_ary, $id);
        $_SESSION['cart'] = $cart_ary;
    }
}

print_r($_SESSION['cart']);

if (!empty($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];

    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value == $remove_id) {
            unset($_SESSION['cart'][$key]);
        }
    }
}
print_r($_SESSION['cart']);




$prev_url = $_SERVER['HTTP_REFERER'];
header("location:$prev_url");

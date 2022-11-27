<?php
session_start();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    if (empty($_SESSION['cart']) || empty($_SESSION['cart'][$id]) || $_SESSION['cart'][$id] <= 0) {
        $_SESSION['cart'][$id] = 1;
    } else {

        // if init array exist
        foreach ($_SESSION['cart'] as $session_id => $qty) {
            if ($id == $session_id) {
                $qty += 1;
                $_SESSION['cart'][$id] = $qty;
            }
        }
    }
}






$prev_url = $_SERVER['HTTP_REFERER'];

header("location:$prev_url");

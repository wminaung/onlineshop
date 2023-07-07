<?php
$my = "hey i am win";
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "onlineshopping";

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword);

mysqli_select_db($conn, $dbname);

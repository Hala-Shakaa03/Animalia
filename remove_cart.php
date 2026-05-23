<?php
session_start();
include "db.php";


$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "animalia_db"
);


if (!$conn) {
    die("Connection Failed");
}


if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];
$user_id = $_SESSION["user_id"];

mysqli_query($conn, "DELETE FROM cart_items WHERE id='$id' AND user_id='$user_id'");

header("Location: cart.php");
exit();
?>
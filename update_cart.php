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
$action = $_GET["action"];
$user_id = $_SESSION["user_id"];

if ($action == "plus") {
    mysqli_query($conn, "UPDATE cart_items SET quantity = quantity + 1 WHERE id='$id' AND user_id='$user_id'");
} else {
    mysqli_query($conn, "UPDATE cart_items SET quantity = quantity - 1 WHERE id='$id' AND user_id='$user_id'");
    mysqli_query($conn, "DELETE FROM cart_items WHERE id='$id' AND quantity <= 0 AND user_id='$user_id'");
}


header("Location: cart.php");
exit();
?>
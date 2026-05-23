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

$user_id = $_SESSION["user_id"];

$cartSql = "SELECT * FROM cart_items WHERE user_id='$user_id'";
$cartResult = mysqli_query($conn, $cartSql);

if (mysqli_num_rows($cartResult) == 0) {
    header("Location: cart.php");
    exit();
}

$total = 0;
$cartItems = [];

while ($item = mysqli_fetch_assoc($cartResult)) {
    $itemTotal = $item["product_price"] * $item["quantity"];
    $total += $itemTotal;
    $cartItems[] = $item;
}

$orderSql = "INSERT INTO orders (user_id, total)
             VALUES ('$user_id', '$total')";

mysqli_query($conn, $orderSql);

$order_id = mysqli_insert_id($conn);

foreach ($cartItems as $item) {

    $name = mysqli_real_escape_string($conn, $item["product_name"]);
    $price = $item["product_price"];
    $image = mysqli_real_escape_string($conn, $item["product_image"]);
    $quantity = $item["quantity"];

    $itemSql = "INSERT INTO order_items
                (order_id, product_name, product_price, product_image, quantity)
                VALUES
                ('$order_id', '$name', '$price', '$image', '$quantity')";

    mysqli_query($conn, $itemSql);
}

$deleteCart = "DELETE FROM cart_items WHERE user_id='$user_id'";
mysqli_query($conn, $deleteCart);

header("Location: cart.php?order=success");
exit();
?>


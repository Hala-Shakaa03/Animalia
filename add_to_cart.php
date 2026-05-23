<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    echo "login";
    exit();


    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "animalia_db"
    );


    if (!$conn) {
        die("Connection Failed");
    }


}

$user_id = $_SESSION["user_id"];

$name = $_POST["name"];
$price = $_POST["price"];
$image = $_POST["image"];
$quantity = $_POST["quantity"];

$check = "SELECT * FROM cart_items
          WHERE user_id='$user_id'
          AND product_name='$name'";

$result = mysqli_query($conn, $check);

if (mysqli_num_rows($result) > 0) {

    $update = "UPDATE cart_items
               SET quantity = quantity + $quantity
               WHERE user_id='$user_id'
               AND product_name='$name'";

    mysqli_query($conn, $update);

} else {

    $insert = "INSERT INTO cart_items
              (user_id, product_name, product_price, product_image, quantity)
              VALUES
              ('$user_id', '$name', '$price', '$image', '$quantity')";

    mysqli_query($conn, $insert);
}

echo "success";
?>
<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$ordersSql =
    "SELECT * FROM orders
 WHERE user_id='$user_id'
 ORDER BY created_at DESC";

$ordersResult =
    mysqli_query($conn, $ordersSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Orders</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="all.css">

    <style>

        body{
            background:#f8f3ed;
            font-family:'Poppins',sans-serif;
            color:#4b3527;
        }

        .orders-container{
            width:90%;
            max-width:1200px;
            margin:50px auto;
        }

        .orders-title{
            font-size:50px;
            margin-bottom:40px;
        }

        .order-box{

            background:white;

            border-radius:30px;

            padding:30px;

            margin-bottom:40px;

            box-shadow:0 10px 25px rgba(0,0,0,.05);
        }

        .order-header{

            display:flex;

            justify-content:space-between;

            margin-bottom:25px;

            border-bottom:1px solid #eee;

            padding-bottom:15px;
        }

        .order-header h2{
            font-size:28px;
        }

        .order-items{
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .order-item{

            display:flex;

            align-items:center;

            justify-content:space-between;

            gap:20px;

            background:#f8f3ed;

            border-radius:20px;

            padding:20px;
        }

        .item-left{
            display:flex;
            align-items:center;
            gap:20px;
        }

        .order-item img{

            width:100px;
            height:100px;

            object-fit:cover;

            border-radius:15px;

            background:white;
        }

        .item-info h3{
            margin-bottom:10px;
            font-size:22px;
        }

        .item-info p{
            color:#7a6a5c;
        }

        .item-total{
            font-size:24px;
            font-weight:700;
            color:#8b5e3c;
        }

        .back-btn{

            display:inline-block;

            margin-bottom:30px;

            text-decoration:none;

            background:#4b3527;

            color:white;

            padding:14px 24px;

            border-radius:999px;

            font-size:16px;

            font-weight:600;

            transition:.3s;
        }

        .back-btn:hover{

            background:#8b5e3c;

            transform:translateY(-3px);
        }

    </style>

</head>

<body>

<div class="orders-container">

    <h1 class="orders-title">
        My Orders
    </h1>
    <a href="profile.php" class="back-btn">
        ← Back to Profile
    </a>

    <?php
    if(mysqli_num_rows($ordersResult) == 0){
        echo "<h2>No orders yet.</h2>";
    }
    ?>

    <?php while($order = mysqli_fetch_assoc($ordersResult)){ ?>

        <div class="order-box">

            <div class="order-header">

                <h2>
                    Order #<?php echo $order["id"]; ?>
                </h2>

                <h3>
                    ₪<?php echo $order["total"]; ?>
                </h3>

            </div>

            <p>
                Date:
                <?php echo $order["created_at"]; ?>
            </p>

            <br>

            <div class="order-items">

                <?php

                $order_id = $order["id"];

                $itemsSql =
                    "SELECT * FROM order_items
                 WHERE order_id='$order_id'";

                $itemsResult =
                    mysqli_query($conn, $itemsSql);

                while($item = mysqli_fetch_assoc($itemsResult)){

                    ?>

                    <div class="order-item">

                        <div class="item-left">

                            <img src="<?php echo $item["product_image"]; ?>">

                            <div class="item-info">

                                <h3>
                                    <?php echo $item["product_name"]; ?>
                                </h3>

                                <p>
                                    Quantity:
                                    <?php echo $item["quantity"]; ?>
                                </p>

                            </div>

                        </div>

                        <div class="item-total">

                            ₪<?php
                            echo $item["product_price"] *
                                $item["quantity"];
                            ?>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    <?php } ?>

</div>

</body>
</html>
<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}
?>
<?php

$conn = mysqli_connect("localhost", "root", "", "animalia_db");

if(!$conn){
    die("Connection Failed");
}


$user_query = mysqli_query($conn, "SELECT * FROM users");

$users_count = mysqli_num_rows($user_query);
$product_query = mysqli_query($conn, "SELECT * FROM products");

$products_count = mysqli_num_rows($product_query);
$orders_count = 0;
$messages_count = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animalia Dashboard</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ICONS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .notification-icon{
            position:relative;
        }

        ..notification-count{

            position:absolute;
            top:5px;
            right:5px;

            background:red;
            color:white;

            min-width:18px;
            height:18px;

            padding:2px;

            border-radius:50%;

            display:flex;
            align-items:center;
            justify-content:center;

            font-size:10px;
            font-weight:bold;
        }
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            background:#f8f3ed;
            display:flex;
            min-height:100vh;
            color:#4b3527;
        }

        /* SIDEBAR */

        .sidebar{
            width:260px;
            background:linear-gradient(to bottom,#4b3527,#7a4f2f);
            padding:35px 22px;
            color:white;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:50px;
        }

        .logo h2{
            font-size:36px;
            font-weight:700;
        }

        .logo i{
            font-size:32px;
            color:#f3d7a1;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:18px;
        }

        .menu a{
            text-decoration:none;
            color:white;
            padding:18px 22px;
            border-radius:18px;
            font-size:18px;
            display:flex;
            align-items:center;
            gap:15px;
            transition:.3s;
        }

        .menu a:hover,
        .menu a.active{
            background:#f3d7a1;
            color:#4b3527;
        }

        /* MAIN */

        .main{
            flex:1;
            padding:35px;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:35px;
        }

        .topbar h1{
            font-size:40px;
        }

        .top-actions{
            display:flex;
            align-items:center;
            gap:18px;
        }


        .icon-circle{
            width:50px;
            height:50px;
            border-radius:50%;
            background:white;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 5px 20px rgba(0,0,0,.04);
        }

        /* STATS */

        .stats{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:25px;
            margin-bottom:35px;
        }

        .stat-card{
            background:white;
            border-radius:28px;
            padding:28px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .stat-top{
            margin-bottom:20px;
        }

        .stat-icon{
            width:70px;
            height:70px;
            border-radius:50%;
            background:#f8f3ed;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
            color:#8b5e3c;
        }

        .stat-card h3{
            font-size:18px;
            color:#8b5e3c;
            margin-bottom:10px;
        }

        .stat-card h2{
            font-size:40px;
        }

        /* BOX */

        .box{
            background:white;
            border-radius:30px;
            padding:30px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
            margin-bottom:30px;
        }

        .box-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .box h2{
            font-size:30px;
        }

        .view-btn{
            text-decoration:none;
            color:#8b5e3c;
            font-weight:600;
        }

        /* ORDERS */

        .order{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:18px 0;
            border-bottom:1px solid #eee;
        }

        .order:last-child{
            border:none;
        }

        .status{
            padding:8px 16px;
            border-radius:999px;
            font-size:14px;
            font-weight:600;
        }

        .completed{
            background:#dff5e3;
            color:#2d8a46;
        }

        .pending{
            background:#ffe8c7;
            color:#d28a00;
        }

        /* TABLE */

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            text-align:left;
            padding-bottom:18px;
            color:#8b5e3c;
        }

        table td{
            padding:18px 0;
            border-top:1px solid #eee;
        }

        @media(max-width:1200px){

            .stats{
                grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:850px){

            body{
                flex-direction:column;
            }

            .sidebar{
                width:100%;
            }

            .stats{
                grid-template-columns:1fr;
            }

            .topbar{
                flex-direction:column;
                gap:20px;
                align-items:flex-start;
            }

            .search-box{
                width:100%;
            }
        }

    </style>
</head>

<body>

<div class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-paw"></i>
        <h2>Animalia</h2>
    </div>

    <div class="menu">

        <a href="dash.php" class="active">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a href="products.php">
            <i class="fa-solid fa-box"></i>
            Products
        </a>

        <a href="Categories.php">
            <i class="fa-solid fa-layer-group"></i>
            Categories
        </a>

        <a href="orders.php">
            <i class="fa-solid fa-cart-shopping"></i>
            Orders
        </a>

        <a href="customer.php">
            <i class="fa-solid fa-users"></i>
            Customers
        </a>

        <a href="messages.php">
            <i class="fa-solid fa-envelope"></i>
            Messages
        </a>

        <a href="settings.php">
            <i class="fa-solid fa-gear"></i>
            Settings
        </a>

        <a href="login.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

</div>

<div class="main">

    <div class="topbar">

        <h1>Welcome Back, Admin 👋</h1>

    </div>

    <!-- STATS -->

    <div class="stats">

        <div class="stat-card">

            <div class="stat-top">
                <div class="stat-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>

            <h3>Total Orders</h3>
            <h2><?php echo $orders_count; ?></h2>

        </div>

        <div class="stat-card">

            <div class="stat-top">
                <div class="stat-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
            </div>

            <h3>Total Products</h3>
            <h2><?php echo $products_count; ?></h2>

        </div>

        <div class="stat-card">

            <div class="stat-top">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <h3>Customers</h3>
            <h2><?php echo $users_count; ?></h2>

        </div>

        <div class="stat-card">

            <div class="stat-top">
                <div class="stat-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </div>

            <h3>Messages</h3>
            <h2><?php echo $messages_count; ?></h2>

        </div>

    </div>
    <div class="box">

        <div class="box-header">

            <h2>Recent Orders</h2>


        </div>

        <?php

        $select_orders = mysqli_query($conn,
                "SELECT * FROM orders");

        if(mysqli_num_rows($select_orders) > 0){

            while($fetch_order = mysqli_fetch_assoc($select_orders)){

                ?>

                <div class="order">

                    <div>

                        <h4>#ORD-<?php echo $fetch_order['id']; ?></h4>

                        <span><?php echo $fetch_order['product_name']; ?></span>

                    </div>

                    <span class="status <?php echo strtolower($fetch_order['status']); ?>">

            <?php echo $fetch_order['status']; ?>

        </span>

                </div>

                <?php
            }
        }else{
            echo "No Orders Found";
        }
        ?>

    </div>
    <div class="box">

        <div class="box-header">

            <h2>Latest Products</h2>


        </div>

        <table>

            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>

            <?php
            if(isset($_GET['search'])){

                $search = $_GET['search'];

                $select_products = mysqli_query($conn,
                        "SELECT * FROM products
             WHERE name LIKE '%$search%'");

            }else{

                $select_products = mysqli_query($conn,
                        "SELECT * FROM products");
            }

            if(mysqli_num_rows($select_products) > 0){

                while($fetch_product = mysqli_fetch_assoc($select_products)){

                    ?>

                    <tr>

                        <td><?php echo $fetch_product['name']; ?></td>

                        <td><?php echo $fetch_product['category']; ?></td>

                        <td>₪<?php echo $fetch_product['price']; ?></td>

                        <td><?php echo $fetch_product['stock']; ?></td>

                    </tr>

                    <?php
                }
            }else{
                echo "<tr><td colspan='4'>No Products Added</td></tr>";
            }
            ?>

        </table>

    </div>
</div>

</body>
</html>
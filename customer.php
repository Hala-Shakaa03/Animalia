<?php

$conn = mysqli_connect("localhost","root","","animalia_db");

if(!$conn){
    die("Connection Failed");
}


$users_query = mysqli_query($conn,
"SELECT * FROM users");

$total_customers = mysqli_num_rows($users_query);
if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query($conn,
            "DELETE FROM users WHERE id='$delete_id'");

    header("Location: customer.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Manager</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            background:#f7f2ec;
            display:flex;
            min-height:100vh;
            color:#4b3527;
        }

        /* SIDEBAR */

        .sidebar{
            width:270px;
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
            font-size:40px;
            font-weight:700;
        }

        .logo i{
            font-size:34px;
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
            display:flex;
            align-items:center;
            gap:15px;
            font-size:18px;
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

        /* TOPBAR */

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:35px;
        }

        .topbar h1{
            font-size:42px;
        }

        .top-right{
            display:flex;
            align-items:center;
            gap:18px;
        }

        .search-box{
            background:white;
            width:340px;
            padding:15px 20px;
            border-radius:999px;
            display:flex;
            align-items:center;
            gap:10px;
            box-shadow:0 5px 20px rgba(0,0,0,.05);
        }

        .search-box input{
            border:none;
            outline:none;
            width:100%;
            background:transparent;
            font-size:15px;
        }

        .icon-circle{
            width:55px;
            height:55px;
            border-radius:50%;
            background:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:20px;
            box-shadow:0 5px 20px rgba(0,0,0,.05);
        }

        /* STATS */

        .stats{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:25px;
            margin-bottom:35px;
        }

        .card{
            background:white;
            padding:28px;
            border-radius:28px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .card-top{
            display:flex;
            align-items:center;
            gap:18px;
            margin-bottom:20px;
        }

        .card-icon{
            width:70px;
            height:70px;
            border-radius:50%;
            background:#f7f2ec;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
            color:#8b5e3c;
        }

        .card h3{
            color:#8b5e3c;
            font-size:18px;
            margin-bottom:8px;
        }

        .card h2{
            font-size:40px;
        }

        /* CUSTOMERS BOX */

        .customers-box{
            background:white;
            border-radius:30px;
            padding:30px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .customers-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .customers-header h2{
            font-size:34px;
        }

        .add-btn{
            border:none;
            background:#7a4f2f;
            color:white;
            padding:14px 22px;
            border-radius:16px;
            cursor:pointer;
            font-size:15px;
            text-decoration:none;
            display:flex;
            align-items:center;
            gap:10px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            text-align:left;
            padding-bottom:18px;
            color:#8b5e3c;
            font-size:16px;
        }

        table td{
            padding:22px 0;
            border-top:1px solid #eee;
        }

        .customer{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .customer-img{
            width:60px;
            height:60px;
            border-radius:50%;
            background:#f7f2ec;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
            color:#8b5e3c;
        }

        .status{
            padding:8px 18px;
            border-radius:999px;
            font-size:14px;
            font-weight:600;
            display:inline-block;
        }

        .active{
            background:#dff5e3;
            color:#2d8a46;
        }

        .blocked{
            background:#ffe0e0;
            color:#d63a3a;
        }

        .actions{
            display:flex;
            gap:10px;
        }

        .action-btn{
            width:40px;
            height:40px;
            border:none;
            border-radius:12px;
            background:#f7f2ec;
            color:#4b3527;
            cursor:pointer;
            transition:.3s;
        }

        .action-btn:hover{
            background:#7a4f2f;
            color:white;
        }

        @media(max-width:1200px){

            .stats{
                grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:850px) {

            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .stats {
                margin-bottom: 35px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            table {
                display: block;
                overflow-x: auto;
            }

            .card {
                width: 300px;
            }
        }
        }

    </style>

</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-paw"></i>
        <h2>Animalia</h2>
    </div>

    <div class="menu">

        <a  href="dash.php">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a  href="products.php">
            <i class="fa-solid fa-box"></i>
            Products
        </a>

        <a href="Categories.php">
            <i class="fa-solid fa-layer-group"></i>
            Categories
        </a>

        <a href="orders.php"  >
            <i class="fa-solid fa-cart-shopping"></i>
            Orders
        </a>

        <a href="customer.php"  class="active">
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
        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>
    </div>

</div>
<!-- MAIN -->

<div class="main">

    <div class="topbar">

        <h1>Customers</h1>

        <div class="top-right">


            <div class="icon-circle">
                <i class="fa-solid fa-user"></i>
            </div>

        </div>

    </div>

    <!-- STATS -->

    <!-- STATS -->

    <div class="stats">

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div>
                    <h3>Total Customers</h3>
                    <h2><?php echo $total_customers; ?></h2>
                </div>

            </div>

        </div>

    </div>

    <!-- CUSTOMERS TABLE -->



    <!-- CUSTOMERS TABLE -->

    <div class="customers-box">

        <div class="customers-header">

            <h2>Manage Customers</h2>


        </div>

        <table>

            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Orders</th>
                <th>Actions</th>
            </tr>

            <?php

            while($fetch_user = mysqli_fetch_assoc($users_query)){

                ?>

                <tr>

                    <td>

                        <div class="customer">

                            <div class="customer-img">
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <div>

                                <h4>
                                    <?php echo $fetch_user['full_name']; ?>
                                </h4>

                                <span>
                    ID: #C00<?php echo $fetch_user['id']; ?>
                </span>

                            </div>

                        </div>

                    </td>

                    <td>
                        <?php echo $fetch_user['email']; ?>
                    </td>

                    <td>
                        <?php echo $fetch_user['phone']; ?>
                    </td>
                    <td>

                        <?php

                        $user_id = $fetch_user['id'];

                        $order_query = mysqli_query($conn,

                                "SELECT * FROM orders
WHERE user_id='$user_id'");

                        $order_count = mysqli_num_rows($order_query);

                        echo $order_count . " Orders";

                        ?>

                    </td>



                    <td>

                        <div class="actions">
                            <a href="view_customer.php?id=<?php echo $fetch_user['id']; ?>"
                               class="action-btn">

                                <i class="fa-solid fa-eye"></i>

                            </a>

                            <a href="edit_customer.php?id=<?php echo $fetch_user['id']; ?>"
                               class="action-btn">

                                <i class="fa-solid fa-pen"></i>

                            </a>
                            <a href="customer.php?delete=<?php echo $fetch_user['id']; ?>"
                               class="action-btn">

                                <i class="fa-solid fa-trash"></i>

                            </a>
                        </div>

                    </td>

                </tr>

                <?php
            }
            ?>
        </table>

    </div>

</div>

</body>
</html>


            <?php

            $conn = mysqli_connect("localhost","root","","animalia_db");

            if(!$conn){
                 die("Connection Failed");
            }




            $total_orders_query = mysqli_query($conn,

                    "SELECT * FROM orders");

            $total_orders = mysqli_num_rows($total_orders_query);




            $revenue_query = mysqli_query($conn,

                    "SELECT SUM(total) AS total_revenue
FROM orders");

            $revenue_data = mysqli_fetch_assoc($revenue_query);

            $total_revenue = $revenue_data['total_revenue'];

            if($total_revenue == null){
                $total_revenue = 0;
            }

            if(isset($_GET['delete'])){

                $delete_id = $_GET['delete'];

                mysqli_query($conn,

                        "DELETE FROM orders
    WHERE id='$delete_id'");

                header("Location: orders.php");
            }



            $orders_query = mysqli_query($conn,

                    "SELECT orders.*,
users.full_name,
users.email

FROM orders

LEFT JOIN users
ON orders.user_id = users.id

ORDER BY orders.id DESC");

            ?>


            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Orders Manager</title>

                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

                    /* TABLE BOX */

                    .orders-box{
                        background:white;
                        border-radius:30px;
                        padding:30px;
                        box-shadow:0 10px 30px rgba(0,0,0,.05);
                    }

                    .orders-header{
                        display:flex;
                        justify-content:space-between;
                        align-items:center;
                        margin-bottom:30px;
                    }

                    .orders-header h2{
                        font-size:34px;
                    }

                    .filter-btn{
                        border:none;
                        background:#7a4f2f;
                        color:white;
                        padding:14px 24px;
                        border-radius:16px;
                        cursor:pointer;
                        font-size:15px;
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
                        width:55px;
                        height:55px;
                        border-radius:50%;
                        background:#f7f2ec;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:20px;
                        color:#8b5e3c;
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
                            align-items:flex-start;
                            gap:20px;
                        }

                        table{
                            display:block;
                            overflow-x:auto;
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

                    <a href="dash.php">
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

                    <a href="orders.php" class="active">
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

            <!-- MAIN -->

            <div class="main">

                <div class="topbar">

                    <h1>Orders</h1>

                    <div class="top-right">

                    </div>

                </div>

                <!-- STATS -->

                <div class="stats">

                    <div class="card">

                        <div class="card-top">

                            <div class="card-icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>

                            <div>
                                <h3>Total Orders</h3>
                                <h2><?php echo $total_orders; ?></h2>                </div>

                        </div>

                    </div>


                    <div class="card">

                        <div class="card-top">

                            <div class="card-icon">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </div>

                            <div>
                                <h3>Total Revenue</h3>
                                <h2>₪<?php echo $total_revenue; ?></h2>                </div>

                        </div>

                    </div>

                </div>

                <!-- ORDERS TABLE -->

                <div class="orders-box">

                    <div class="orders-header">

                        <h2>Recent Orders</h2>



                    </div>

                    <table>

                        <tr>
                            <th>Customer</th>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Total</th>

                            <th>Actions</th>
                        </tr>
                        <?php

                        while($order = mysqli_fetch_assoc($orders_query)){

                            ?>

                            <tr>

                                <td>

                                    <div class="customer">

                                        <div class="customer-img">
                                            <i class="fa-solid fa-user"></i>
                                        </div>

                                        <div>

                                            <h4>
                                                <?php echo $order['full_name']; ?>
                                            </h4>

                                            <span>
<?php echo $order['email']; ?>
</span>

                                        </div>

                                    </div>

                                </td>

                                <td>
                                    #ORD-<?php echo $order['id']; ?>
                                </td>

                                <td>
                                    Order
                                </td>

                                <td>
                                    ₪<?php echo $order['total']; ?>
                                </td>


                                <td>

                                    <div class="actions">

                                        <a
                                                href="view_order.php?id=<?php echo $order['id']; ?>"
                                                class="action-btn">

                                            <i class="fa-solid fa-eye"></i>

                                        </a>

                                        <a
                                                href="orders.php?delete=<?php echo $order['id']; ?>"
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

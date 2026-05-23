<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "animalia_db"
);

if(!$conn){


    die("Connection Failed");
}

$query = "
SELECT * FROM contact_messages
ORDER BY id DESC
";

$result = mysqli_query($conn , $query);

$total_messages = mysqli_num_rows($result);
$read_query = mysqli_query($conn,

        "SELECT * FROM contact_messages
WHERE status='read'");

$read_count = mysqli_num_rows($read_query);



$unread_query = mysqli_query($conn,

        "SELECT * FROM contact_messages
WHERE status='unread'");

$unread_count = mysqli_num_rows($unread_query);
$today_query = "
SELECT * FROM contact_messages
WHERE DATE(created_at)=CURDATE()
";

$today_result = mysqli_query($conn , $today_query);

$today_count = mysqli_num_rows($today_result);
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $delete_query = "
    DELETE FROM contact_messages
    WHERE id='$id'
    ";

    mysqli_query($conn , $delete_query);

    header("Location: messages.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages Manager</title>

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

        /* MESSAGES BOX */

        .messages-box{
            background:white;
            border-radius:30px;
            padding:30px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .messages-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .messages-header h2{
            font-size:34px;
        }

        .message{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            padding:25px 0;
            border-top:1px solid #eee;
            gap:20px;
        }

        .message-left{
            display:flex;
            gap:18px;
        }

        .message-img{
            width:65px;
            height:65px;
            border-radius:50%;
            background:#f7f2ec;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:24px;
            color:#8b5e3c;
        }

        .message-content h3{
            margin-bottom:6px;
        }

        .message-content p{
            color:#777;
            line-height:1.6;
            margin-top:10px;
            max-width:700px;
        }

        .message-time{
            color:#999;
            font-size:14px;
            white-space:nowrap;
        }

        .actions{
            display:flex;
            gap:10px;
            margin-top:15px;
        }

        .action-btn{
            width:42px;
            height:42px;
            border:none;
            border-radius:12px;
            background:#f7f2ec;
            color:#4b3527;
            cursor:pointer;
            transition:.3s;
            display:flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
        }

        .action-btn:hover{
            background:#7a4f2f;
            color:white;
        }

        .unread{
            width:12px;
            height:12px;
            background:#d63a3a;
            border-radius:50%;
            margin-top:8px;
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

            .message{
                flex-direction:column;
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

        <a  href="../../../Users/AWE/PhpstormProjects/Animalia/dash.php">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a  href="products.php" >
            <i class="fa-solid fa-box"></i>
            Products
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/Categories.php">
            <i class="fa-solid fa-layer-group"></i>
            Categories
        </a>

        <a href="orders.php"  >
            <i class="fa-solid fa-cart-shopping"></i>
            Orders
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/customer.php">
            <i class="fa-solid fa-users"></i>
            Customers
        </a>

        <a href="messages.php" class="active">
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

        <h1>Messages</h1>

        <div class=" top-right">



        </div>

    </div >

    <!-- STATS -->

    <div class="stats">

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div>
                    <h3>Total Messages</h3>
                    <h2><?php echo $total_messages; ?></h2>                </div>

            </div>

        </div>

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-envelope-open"></i>
                </div>

                <div>
                    <h3>Read</h3>
                    <h2><?php echo $read_count; ?></h2>             </div>

            </div>

        </div>

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>

                <div>
                    <h3>Unread</h3>
                    <h2><?php echo $unread_count; ?></h2>              </div>

            </div>

        </div>

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <div>
                    <h3>Today</h3>
                    <h2><?php echo $today_count; ?></h2>                </div>

            </div>

        </div>

    </div>

    <!-- MESSAGES -->

    <div class="messages-box">

        <div class="messages-header">

            <h2>Recent Messages</h2>

        </div>

        <!-- MESSAGE -->

        <!-- MESSAGE -->
        <?php while($row = mysqli_fetch_assoc($result)){
            $status = $row['status'];?>
            <div class="message">

                <div class="message-left">

                    <div class="message-img">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div class="message-content">

                        <h3>
                            <?php echo $row['full_name']; ?>
                        </h3>

                        <span>
                <?php echo $row['email']; ?>
            </span>

                        <?php if(!empty($row['subject'])){ ?>

                            <p style="font-weight:600;color:#4b3527;">
                                Subject:
                                <?php echo $row['subject']; ?>
                            </p>

                        <?php } ?>

                        <p>
                            <?php echo $row['message']; ?>
                        </p>

                        <div class="actions">

                            <a
                                    href="mailto:<?php echo $row['email']; ?>"
                                    class="action-btn">

                                <i class="fa-solid fa-reply"></i>

                            </a>

                            <a
                                    href="messages.php?delete=<?php echo $row['id']; ?>"
                                    class="action-btn">

                                <i class="fa-solid fa-trash"></i>

                            </a>

                        </div>
                    </div>

                </div>

                <div>

        <span class="message-time">
            <?php if($status == "unread"){ ?>

                <div class="unread"></div>

            <?php } ?>
            <?php echo $row['created_at']; ?>
        </span>

                </div>

            </div>

        <?php } ?>
</div>

</body>
</html>
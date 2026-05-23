<?php

$conn = mysqli_connect("localhost","root","","animalia_db");

$id = $_GET['id'];

$query = mysqli_query($conn,
    "SELECT * FROM users WHERE id='$id'");

$user = mysqli_fetch_assoc($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Customer</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        body{
            font-family:'Poppins',sans-serif;
            background:#f7f2ec;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .box{
            width:500px;
            background:white;
            padding:40px;
            border-radius:30px;
        }

        h1{
            margin-bottom:30px;
            color:#4b3527;
        }

        .info{
            margin-bottom:20px;
        }

        .info span{
            display:block;
            color:#999;
            margin-bottom:5px;
        }

        .info h3{
            color:#4b3527;
        }

    </style>

</head>
<body>

<div class="box">

    <h1>Customer Details</h1>

    <div class="info">

        <span>Full Name</span>

        <h3><?php echo $user['full_name']; ?></h3>

    </div>

    <div class="info">

        <span>Email</span>

        <h3><?php echo $user['email']; ?></h3>

    </div>

    <div class="info">

        <span>Phone</span>

        <h3><?php echo $user['phone']; ?></h3>

    </div>
    <div class="info">

        <span>Address</span>

        <h3><?php echo $user['address']; ?></h3>

    </div>
</div>

</body>
</html>
<?php

$conn = mysqli_connect("localhost","root","","animalia_db");

$id = $_GET['id'];


$query  = mysqli_query($conn,
    "SELECT * FROM users WHERE id='$id'");

$user = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    mysqli_query($conn,

        "UPDATE users SET

    full_name='$full_name',
    email='$email',
    phone='$phone',
    address='$address'

    WHERE id='$id'");

    header("Location: customer.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Customer</title>

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

        .input-group{
            margin-bottom:20px;
        }

        .input-group label{
            display:block;
            margin-bottom:10px;
            font-weight:600;
        }

        .input-group input{
            width:100%;
            padding:15px;
            border:none;
            outline:none;
            background:#f7f2ec;
            border-radius:16px;
        }

        button{
            width:100%;
            padding:16px;
            border:none;
            border-radius:16px;
            background:#7a4f2f;
            color:white;
            font-size:16px;
            cursor:pointer;
        }

    </style>

</head>
<body>

<div class="box">

    <h1>Edit Customer</h1>

    <form method="POST">

        <div class="input-group">

            <label>Full Name</label>

            <input
                type="text"
                name="full_name"
                value="<?php echo $user['full_name']; ?>">

        </div>

        <div class="input-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="<?php echo $user['email']; ?>">

        </div>

        <div class="input-group">

            <label>Phone</label>

            <input
                type="text"
                name="phone"
                value="<?php echo $user['phone']; ?>">

        </div>
        <div class="input-group">

            <label>Address</label>

            <input
                type="text"
                name="address"
                value="<?php echo $user['address']; ?>">

        </div>
        <button
            type="submit"
            name="update">

            Update Customer

        </button>

    </form>

</div>

</body>
</html>
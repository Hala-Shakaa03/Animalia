

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


$query = "SELECT * FROM settings WHERE id=1";
$result = mysqli_query($conn, $query);
$data  = mysqli_fetch_assoc($result);

if(isset($_POST['save'])){

    $store_name = $_POST['store_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $currency = $_POST['currency'];

    $update = "
  UPDATE settings SET
  store_name='$store_name',
  email='$email',
  phone='$phone',
  address='$address',
  currency='$currency'
  WHERE id=1
  ";

    mysqli_query($conn , $update);

//    header("Location: settings.php?success=1");
    echo "<script>
alert('Settings Updated Successfully');
window.location.href='settings.php';
</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

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

        .main{
            flex:1;
            padding:35px;
        }

        .topbar{
            margin-bottom:35px;
        }

        .topbar h1{
            font-size:42px;
        }

        .settings-container{
            display:grid;
            grid-template-columns:1fr;
            gap:30px;
        }
        .settings-box{
            background:white;
            border-radius:30px;
            padding:35px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .settings-box h2{
            margin-bottom:30px;
            font-size:30px;
        }

        .input-group{
            margin-bottom:25px;
        }

        .input-group label{
            display:block;
            margin-bottom:10px;
            font-weight:600;
            color:#7a4f2f;
        }

        .input-group input,
        .input-group textarea,
        .input-group select{
            width:100%;
            padding:16px;
            border:none;
            outline:none;
            background:#f7f2ec;
            border-radius:16px;
            font-size:15px;
            color:#4b3527;
        }

        textarea{
            resize:none;
            height:120px;
        }

        .save-btn{
            border:none;
            background:#7a4f2f;
            color:white;
            padding:16px 28px;
            border-radius:16px;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
        }

        .save-btn:hover{
            background:#4b3527;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:15px;
            border-radius:14px;
            margin-bottom:25px;
            font-weight:600;
        }

        .profile-card{
            background:white;
            border-radius:30px;
            padding:35px;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .profile-img{
            width:120px;
            height:120px;
            border-radius:50%;
            background:#f7f2ec;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            font-size:45px;
            color:#7a4f2f;
            margin-bottom:20px;
        }

        .profile-card h2{
            margin-bottom:10px;
        }

        .profile-card p{
            color:#888;
            margin-bottom:30px;
        }

        .profile-info{
            text-align:left;
            margin-top:25px;
        }

        .profile-info div{
            margin-bottom:18px;
        }

        .profile-info span{
            color:#888;
            font-size:14px;
        }

        .profile-info h4{
            margin-top:5px;
        }

        @media(max-width:1000px){

            .settings-container{
                grid-template-columns:1fr;
            }
        }

        @media(max-width:850px){

            body{
                flex-direction:column;
            }

            .sidebar{
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

        <a  href="../../../Users/AWE/PhpstormProjects/Animalia/dash.php">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a  href="../../../Users/AWE/PhpstormProjects/Animalia/products.php" >
            <i class="fa-solid fa-box"></i>
            Products
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/Categories.php">
            <i class="fa-solid fa-layer-group"></i>
            Categories
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/orders.php"  >
            <i class="fa-solid fa-cart-shopping"></i>
            Orders
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/customer.php">
            <i class="fa-solid fa-users"></i>
            Customers
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/messages.php" >
            <i class="fa-solid fa-envelope"></i>
            Messages
        </a>
        <a href="settings.php" class="active">
            <i class="fa-solid fa-gear"></i>
            Settings
        </a>
        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>
    </div>

</div>
<div class="main">

    <div class="topbar">
        <h1>Settings</h1>
    </div>

    <div class="settings-container">

        <div class="settings-box">

            <h2>Store Settings</h2>

            <?php if(isset($_GET['success'])){ ?>
                <div class="success">
                    Settings Updated Successfully
                </div>
            <?php } ?>

            <form method="POST">

                <div class="input-group">
                    <label>Store Name</label>

                    <input
                        type="text"
                        name="store_name"
                        value="<?php echo $data['store_name']; ?>"
                        required>
                </div>

                <div class="input-group">
                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        value="<?php echo $data['email']; ?>"
                        required>
                </div>

                <div class="input-group">
                    <label>Phone Number</label>

                    <input
                        type="text"
                        name="phone"
                        value="<?php echo $data['phone']; ?>"
                        required>
                </div>

                <div class="input-group">
                    <label>Store Address</label>

                    <textarea name="address" required><?php echo $data['address']; ?></textarea>
                </div>

                <div class="input-group">

                    <label>Currency</label>

                    <select name="currency">

                        <option
                            <?php if($data['currency']=="ILS - ₪") echo "selected"; ?>>
                            ILS - ₪
                        </option>

                        <option
                            <?php if($data['currency']=="USD - $") echo "selected"; ?>>
                            USD - $
                        </option>

                        <option
                            <?php if($data['currency']=="JOD - JD") echo "selected"; ?>>
                            JOD - JD
                        </option>

                    </select>

                </div>

                <button type="submit" name="save" class="save-btn">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Changes
                </button>

            </form>

        </div>


        </div>

        </div>

    </div>

</div>

</body>
</html>
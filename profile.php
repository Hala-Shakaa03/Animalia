<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - Animalia</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body class="login-page">

<div class="login-box">

    <div class="login-left">

        <div class="login-logo">
            <img src="imgs/logo.png" alt="Animalia Logo">
        </div>

        <h2>My Profile</h2>

        <div class="success-message">
            Welcome, <?php echo $_SESSION["user_name"]; ?>!
        </div>

        <p>
            Email: <?php echo $_SESSION["user_email"]; ?>
        </p>

        <?php if(isset($_GET['success'])) { ?>
            <div class="success-message">
                Password updated successfully!
            </div>
        <?php } ?>

        <?php if(isset($_GET['error'])) { ?>
            <div class="error-message">
                Passwords do not match.
            </div>
        <?php } ?>

        <a href="change-password.php" class="home-link">
            Change Password
        </a>

        <a href="my_orders.php" class="home-link">
            My Orders
        </a>

        <a href="logout.php" class="home-link">
            Logout
        </a>

        <a href="p1.php" class="home-link">
            ← Back to Home
        </a>

    </div>

    <div class="login-right">
        <img src="imgs/log.png" alt="Pets">
    </div>

</div>

</body>
</html>
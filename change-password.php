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
    <title>Change Password - Animalia</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body class="login-page">

<div class="login-box">

    <div class="login-left">

        <div class="login-logo">
            <img src="imgs/logo.png" alt="Animalia Logo">
        </div>

        <h2>Change Password</h2>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'old') { ?>
            <div class="error-message">
                Current password is incorrect.
            </div>
        <?php } ?>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'match') { ?>
            <div class="error-message">
                New passwords do not match.
            </div>
        <?php } ?>

        <form action="change_password.php" method="POST">

            <input type="password"
                   name="old_password"
                   placeholder="Current Password"
                   required>

            <input type="password"
                   name="new_password"
                   placeholder="New Password"
                   required>

            <input type="password"
                   name="confirm_password"
                   placeholder="Confirm New Password"
                   required>

            <button type="submit">
                Save New Password
            </button>

        </form>

        <a href="profile.php" class="home-link">
            ← Back to Profile
        </a>

    </div>

    <div class="login-right">
        <img src="imgs/log.png" alt="Pets">
    </div>

</div>

</body>
</html>
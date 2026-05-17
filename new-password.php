<?php

include "db.php";

$token = $_GET["token"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Password</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body class="login-page">

<div class="login-box">

    <div class="login-left">

        <div class="login-logo">
            <img src="imgs/logo.png" alt="Animalia Logo">
        </div>

        <h2>Create New Password</h2>

        <?php if(isset($_GET['error'])) { ?>
            <div class="error-message">
                Passwords do not match.
            </div>
        <?php } ?>

        <form action="update_password.php" method="POST">

            <input type="hidden"
                   name="token"
                   value="<?php echo $token; ?>">

            <input type="password"
                   name="new_password"
                   placeholder="New Password"
                   required>

            <input type="password"
                   name="confirm_password"
                   placeholder="Confirm New Password"
                   required>

            <button type="submit">
                Update Password
            </button>

        </form>

    </div>

    <div class="login-right">
        <img src="imgs/log.png" alt="Pets">
    </div>

</div>

</body>
</html>
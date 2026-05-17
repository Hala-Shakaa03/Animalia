<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - PetWorld</title>

    <link rel="stylesheet" href="style2.css">
</head>

<body class="login-page">

<div class="login-box">

    <div class="login-left">

        <div class="login-logo">
            <img src="imgs/logo.png" alt="PetWorld Logo">
        </div>

        <h2>Login to Account</h2>

        <p>
            Welcome back! Please login
            to continue.
        </p>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'registered') { ?>
            <div class="success-message">
                Account created successfully! Please login.
            </div>
        <?php } ?>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'email') { ?>
            <div class="success-message">
                Password reset link has been sent to your email.
            </div>
        <?php } ?>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'reset') { ?>
            <div class="success-message">
                Password reset successfully! Please login.
            </div>
        <?php } ?>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'wrong') { ?>
            <div class="error-message">
                Incorrect password. Please try again.
            </div>
        <?php } ?>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'notfound') { ?>
            <div class="error-message">
                Email not found. Please register first.
            </div>
        <?php } ?>

        <form action="login_process.php" method="POST">

            <input type="email"
                   name="email"
                   placeholder="Email Address"
                   required>

            <input type="password"
                   name="password"
                   placeholder="Password"
                   required>

            <button type="submit">
                Login
            </button>

        </form>

        <a href="forgot-password.php" class="forgot">
            Forgot Password?
        </a>

        <p class="register-text">
            Don’t have an account?
            <a href="register.php">Register</a>
        </p>

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
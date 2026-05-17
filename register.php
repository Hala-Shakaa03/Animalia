<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Register - Animalia
    </title>

    <!-- CSS -->

    <link rel="stylesheet" href="register.css">

    <!-- FONT AWESOME -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style2.css">

</head>

<body class="register-page">

<div class="register-box">

    <!-- =========================
         LEFT SIDE
    ========================= -->

    <div class="register-left">

        <!-- LOGO -->

        <div class="register-logo">

            <img src="imgs/logo.png"
                 alt="Animalia Logo">

        </div>

        <!-- TITLE -->

        <h2>
            Create Account
        </h2>

        <p>
            Join us today! Please fill in the details to register.
        </p>
        <?php if(isset($_GET['error']) && $_GET['error'] == 'email') { ?>
            <div class="error-message">
                This email is already registered.
            </div>
        <?php } ?>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'password') { ?>
            <div class="error-message">
                Passwords do not match.
            </div>
        <?php } ?>

        <!-- FORM -->

        <form action="register_process.php" method="POST">

            <div class="input-box">

                <i class="fa-regular fa-user"></i>

                <input type="text"
                       name="full_name"
                       placeholder="Full Name"
                       required>

            </div>

            <div class="input-box">

                <i class="fa-regular fa-envelope"></i>

                <input type="email"
                       name="email"
                       placeholder="Email Address"
                       required>

            </div>

            <div class="input-box">

                <i class="fa-solid fa-lock"></i>

                <input type="password"
                       name="password"
                       placeholder="Password"
                       required>

            </div>

            <div class="input-box">

                <i class="fa-solid fa-lock"></i>

                <input type="password"
                       name="confirm_password"
                       placeholder="Confirm Password"
                       required>

            </div>

            <div class="input-box">

                <i class="fa-solid fa-phone"></i>

                <input type="text"
                       name="phone"
                       placeholder="Phone Number (Optional)">

            </div>

            <button type="submit" name="register">

                Create Account

            </button>

        </form>

        <!-- LOGIN -->

        <p class="login-text">

            Already have an account?

            <a href="login.php">
                Login
            </a>

        </p>

        <!-- HOME -->

        <a href="p1.php"
           class="home-link">

            ← Back to Home

        </a>

    </div>

    <!-- =========================
         RIGHT SIDE
    ========================= -->

    <div class="register-right">

        <img src="imgs/log.png"
             alt="Pets">

    </div>

</div>

</body>

</html>
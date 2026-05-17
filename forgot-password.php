<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Forgot Password - Animalia
    </title>

    <!-- CSS -->

    <link rel="stylesheet"
          href="style2.css">

    <!-- FONT AWESOME -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="login-page">

<div class="login-box">

    <!-- LEFT SIDE -->

    <div class="login-left">

        <!-- LOGO -->

        <div class="login-logo">

            <img src="imgs/logo.png"
                 alt="Animalia Logo">

        </div>

        <!-- TITLE -->

        <h2>
            Forgot Password?
        </h2>

        <!-- TEXT -->

        <p>
            No worries! Enter your email address
            and we’ll send you a link to reset
            your password.
        </p>
        <?php if(isset($_GET['error'])) { ?>
            <div class="error-message">
                Email not found or passwords do not match.
            </div>
        <?php } ?>
        <!-- FORM -->

        <form action="reset_password.php" method="POST">

            <input type="email"
                   name="email"
                   placeholder="Email Address"
                   required>

            <button type="submit">

                Send Reset Link

            </button>

        </form>

        <!-- BACK -->

        <a href="login.php"
           class="home-link">

            ← Back to Login

        </a>

    </div>

    <!-- RIGHT SIDE -->

    <div class="login-right">

        <img src="imgs/log.png"
             alt="Pets">

    </div>

</div>

</body>

</html>
<?php
session_start();
include "db.php";

$cartCount = 0;

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    $countSql = "SELECT SUM(quantity) AS total FROM cart_items WHERE user_id='$user_id'";
    $countResult = mysqli_query($conn, $countSql);
    $countRow = mysqli_fetch_assoc($countResult);

    $cartCount = $countRow["total"] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Contact Us - Animalia</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="all.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            background:#f8f3ed;
            color:#4b3527;
        }

        .container{
            width:90%;
            max-width:1400px;
            margin:auto;
        }

        /* =========================
           CONTACT HERO
        ========================= */

        .contact-hero{
            padding:50px 0;
        }

        .contact-hero-content{
            background:linear-gradient(135deg,#f7efe7,#f3e4d6);
            border-radius:40px;
            padding:60px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:40px;
            overflow:hidden;
        }

        .hero-text{
            max-width:550px;
        }

        .hero-text h1{
            font-size:70px;
            margin-bottom:20px;
            color:#3e2414;
        }

        .hero-text p{
            font-size:20px;
            line-height:1.8;
            color:#7a6a5c;
        }

        .hero-image img{
            width:420px;
        }

        /* =========================
           CONTACT SECTION
        ========================= */

        .contact-section{
            padding:20px 0 90px;
        }

        .contact-grid{
            display:grid;
            grid-template-columns:1fr 1.2fr;
            gap:35px;
        }

        /* INFO BOXES */

        .contact-info{
            display:grid;
            gap:25px;
        }

        .info-box{
            background:white;
            border-radius:28px;
            padding:30px;
            display:flex;
            align-items:center;
            gap:20px;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
            transition:.3s;
        }

        .info-box:hover{
            transform:translateY(-5px);
        }

        .info-box i{
            width:70px;
            height:70px;
            border-radius:50%;
            background:#f3e2d1;
            color:#8b5e3c;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
            flex-shrink:0;
        }

        .info-box h3{
            margin-bottom:8px;
            font-size:24px;
        }

        .info-box p{
            color:#7a6a5c;
            line-height:1.7;
        }

        /* FORM */

        .contact-form-box{
            background:white;
            border-radius:30px;
            padding:45px;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
        }

        .contact-form-box h2{
            font-size:42px;
            margin-bottom:30px;
            text-align:center;
            color:#3e2414;
        }

        .contact-form-box form{
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .contact-form-box input,
        .contact-form-box textarea{

            width:100%;

            border:none;
            outline:none;

            background:#f7efe7;

            padding:20px;

            border-radius:18px;

            font-size:16px;

            color:#4b3527;
        }

        .contact-form-box textarea{
            height:180px;
            resize:none;
        }

        .contact-form-box button{

            border:none;

            background:linear-gradient(to right,#4b3527,#9a673d);

            color:white;

            padding:18px;

            border-radius:999px;

            font-size:18px;

            font-weight:700;

            cursor:pointer;

            transition:.3s;
        }

        .contact-form-box button:hover{
            transform:translateY(-4px);
        }

        .contact-form-box button i{
            margin-right:10px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width:1000px){

            .contact-grid{
                grid-template-columns:1fr;
            }

            .contact-hero-content{
                flex-direction:column;
                text-align:center;
            }

            .hero-text h1{
                font-size:50px;
            }

            .hero-image img{
                width:300px;
            }
        }

        @media(max-width:700px){

            .hero-text h1{
                font-size:38px;
            }

            .hero-text p{
                font-size:16px;
            }

            .contact-form-box{
                padding:30px 20px;
            }

            .contact-form-box h2{
                font-size:30px;
            }

            .info-box{
                padding:20px;
            }
        }

    </style>

</head>

<body>

<!-- =========================
     TOPBAR
========================= -->

<div class="topbar">

    <div class="topbar-left">
        <i class="fa-solid fa-phone"></i>
        +970 59 876 5432
    </div>

    <div class="topbar-center">
        <i class="fa-solid fa-truck"></i>
        Free delivery on orders over ₪100
    </div>

    <div class="topbar-right">

        <a href="#">
            <i class="fa-brands fa-facebook-f"></i>
        </a>

        <a href="#">
            <i class="fa-brands fa-instagram"></i>
        </a>

        <a href="#">
            <i class="fa-brands fa-twitter"></i>
        </a>

    </div>

</div>

<!-- =========================
     HEADER
========================= -->

<header class="header">

    <div class="container header-content">

        <!-- LOGO -->

        <div class="logo">

            <img src="imgs/logo.png" alt="Animalia Logo">

        </div>

        <!-- NAVBAR -->

        <nav class="navbar">

            <ul>

                <li>
                    <a href="p1.php">
                        Home
                    </a>
                </li>

                <li class="dropdown">

                    <a href="#">
                        Store
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>

                    <ul class="dropdown-menu">

                        <li>
                            <a href="cat.php">Cats</a>
                        </li>

                        <li>
                            <a href="dog.php">Dogs</a>
                        </li>

                        <li>
                            <a href="bird.php">Birds</a>
                        </li>

                        <li>
                            <a href="fish.php">Aquarium</a>
                        </li>

                    </ul>

                </li>

                <li>
                    <a href="about.html">
                        About
                    </a>
                </li>

                <li>
                    <a href="contact.html" class="active">
                        Contact Us
                    </a>
                </li>

            </ul>

        </nav>

        <!-- ACTIONS -->

        <div class="header-actions">

            <div class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text"
                       placeholder="Search products...">

            </div>

            <a href="#" class="icon-btn">

                <i class="fa-solid fa-user"></i>

            </a>

            <a href="cart.php" class="icon-btn cart-btn">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-number"><?php echo $cartCount; ?></span>
            </a>

        </div>

    </div>

</header>

<!-- =========================
     HERO
========================= -->

<section class="contact-hero">

    <div class="container contact-hero-content">

        <div class="hero-text">

            <h1>
                Contact Us
            </h1>

            <p>
                Have questions? We'd love to hear from you.
                Get in touch with our team anytime and we'll help you with anything your pets need.
            </p>

        </div>

        <div class="hero-image">

            <img src="imgs/petsss.png"
                 alt="Pets">

        </div>

    </div>

</section>

<!-- =========================
     CONTACT SECTION
========================= -->

<section class="contact-section">

    <div class="container contact-grid">

        <!-- LEFT -->

        <div class="contact-info">

            <div class="info-box">

                <i class="fa-solid fa-phone"></i>

                <div>

                    <h3>Phone</h3>

                    <p>
                        +970 59 876 5432
                    </p>

                </div>

            </div>

            <div class="info-box">

                <i class="fa-solid fa-envelope"></i>

                <div>

                    <h3>Email</h3>

                    <p>
                        Animaliaproject4@gmail.com
                    </p>

                </div>

            </div>

            <div class="info-box">

                <i class="fa-solid fa-location-dot"></i>

                <div>

                    <h3>Location</h3>

                    <p>
                        Nablus - Palestine
                    </p>

                </div>

            </div>

            <div class="info-box">

                <i class="fa-solid fa-clock"></i>

                <div>

                    <h3>Working Hours</h3>

                    <p>
                        9 AM - 10 PM
                    </p>

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="contact-form-box">

            <h2>
                Send Us a Message
            </h2>

            <form action="send_message.php" method="POST">

                <input type="text" name="subject" placeholder="Subject" required>

                <textarea name="message" placeholder="Your Message..." required></textarea>

                <button type="submit">

                    <i class="fa-solid fa-paper-plane"></i>

                    Send Message

                </button>

            </form>

        </div>

    </div>

</section>

<!-- =========================
     FOOTER
========================= -->

<footer class="footer">

    <div class="footer-content">

        <div class="footer-box">

            <h3>
                About
            </h3>

            <a href="#">
                Privacy Policy
            </a>

            <a href="#">
                Terms & Conditions
            </a>

            <a href="#">
                Promotional Offers
            </a>

        </div>

        <div class="footer-box">

            <h3>
                Help
            </h3>

            <a href="#">
                Customer Help
            </a>

            <a href="contact.html">
                Contact Us
            </a>

            <a href="#">
                Refund & Returns
            </a>

        </div>

        <div class="footer-box">

            <h3>
                Follow
            </h3>

            <a href="#">
                Instagram
            </a>

            <a href="#">
                TikTok
            </a>

            <a href="#">
                Facebook
            </a>

            <a href="#">
                Twitter
            </a>

        </div>

    </div>

    <div class="footer-bottom">

        © 2026 Animalia Pet Store — All Rights Reserved

    </div>

</footer>

</body>
</html>
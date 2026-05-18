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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animalia Pet Store</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet"
          href="all.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
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
        Free delivery on orders over $100
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
                    <a href="#" class="active">Home</a>
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
                    <a href="#">About</a>
                </li>

                <li>
                    <a href="contact.php">
                        Contact Us</a>
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

            <a href="#" class="icon-btn" id="userBtn">

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

<section class="hero">

    <div class="container hero-content">

        <!-- HERO TEXT -->

        <div class="hero-text">


            <h1>
                Make Your Pets
                Happy Every Day
            </h1>

            <p>
                Discover premium food, toys, accessories and grooming
                products for your lovely pets with the best quality and prices.
            </p>

            <div class="hero-buttons">

                <a href="about.html" class="main-btn">
                    About Us

                    <i class="fa-solid fa-cart-shopping"></i>

                </a>



            </div>

            <!-- STATS -->

            <div class="hero-stats">

                <div class="stat-box">

                    <i class="fa-solid fa-paw"></i>

                    <div>
                        <h3>12K+</h3>
                        <span>Happy Clients</span>
                    </div>

                </div>

                <div class="stat-box">

                    <i class="fa-solid fa-box"></i>

                    <div>
                        <h3>500+</h3>
                        <span>Pet Products</span>
                    </div>

                </div>

                <div class="stat-box">

                    <i class="fa-solid fa-headset"></i>

                    <div>
                        <h3>24/7</h3>
                        <span>Support</span>
                    </div>

                </div>

            </div>

        </div>

        <!-- HERO IMAGE -->

        <div class="hero-image">


            <img src="imgs/petsss.png" alt="Pets">

        </div>

    </div>

</section>

<!-- =========================
     CATEGORIES
========================= -->
<section class="categories" id="categories">

    <div class="container">

        <div class="pets-cards">

            <!-- CAT -->

            <a href="cat.php" class="pet-item">

                <div class="pet-image">

                    <img src="imgs/cato.png"
                         class="cat-img"
                         alt="Cat">

                </div>

                <div class="pet-info">

                    <h3>Cat Supplies</h3>

                    <span>Food • Toys • Care</span>

                </div>

            </a>

            <!-- DOG -->

            <a href="dog.php" class="pet-item">

                <div class="pet-image">

                    <img src="imgs/gf.png"
                         class="dog-img"
                         alt="Dog">

                </div>

                <div class="pet-info">

                    <h3>Dog Supplies</h3>

                    <span>Food • Toys • Care</span>

                </div>

            </a>

            <!-- BIRD -->

            <a href="bird.php" class="pet-item">

                <div class="pet-image">

                    <img src="imgs/bird.png"
                         class="bird-img"
                         alt="Bird">

                </div>

                <div class="pet-info">

                    <h3>Bird Supplies</h3>

                    <span>Cages • Food • Perches</span>

                </div>

            </a>

            <!-- FISH -->

            <a href="fish.php" class="pet-item">

                <div class="pet-image">

                    <img src="imgs/fish.png"
                         class="fish-img"
                         alt="Fish">

                </div>

                <div class="pet-info">

                    <h3>Aquarium</h3>

                    <span>Food • Tanks • Decor</span>

                </div>

            </a>

        </div>

    </div>

</section>

<section class="features">

    <div class="container features-grid">

        <div class="feature-box">

            <i class="fa-solid fa-truck"></i>

            <div>

                <h3>Free Delivery</h3>

                <p>On orders over $100</p>

            </div>

        </div>

        <div class="feature-box">

            <i class="fa-solid fa-shield"></i>

            <div>

                <h3>Secure Payment</h3>

                <p>100% protected</p>

            </div>

        </div>

        <div class="feature-box">

            <i class="fa-solid fa-award"></i>

            <div>

                <h3>Quality Products</h3>

                <p>Best quality for pets</p>

            </div>

        </div>

        <div class="feature-box">

            <i class="fa-solid fa-headset"></i>

            <div>

                <h3>24/7 Support</h3>

                <p>We are here to help</p>

            </div>

        </div>

    </div>

</section>
<!-- =========================
     FOOTER
========================= -->

<footer class="footer">

    <div class="footer-content">

        <!-- ABOUT -->

        <div class="footer-box">

            <h3>About</h3>

            <a href="#">Privacy Policy</a>

            <a href="#">Terms & Conditions</a>

            <a href="#">Promotional Offers</a>

        </div>

        <!-- HELP -->

        <div class="footer-box">

            <h3>Help</h3>

            <a href="#">Customer Help</a>

            <a href="#">Contact Us</a>

            <a href="#">Refund & Returns</a>

        </div>

        <!-- FOLLOW -->

        <div class="footer-box">

            <h3>Follow</h3>

            <a href="#">Instagram</a>

            <a href="#">TikTok</a>

            <a href="#">Facebook</a>

            <a href="#">Twitter</a>

        </div>



            <!-- PAYMENT -->


        </div>

    </div>

    <!-- BOTTOM -->

    <div class="footer-bottom">

        © 2026 Animalia Pet Store — All Rights Reserved

    </div>

</footer>

<script>

    let isLoggedIn = <?php echo isset($_SESSION["user_id"]) ? "true" : "false"; ?>;

    // false = مو مسجل
    // true = مسجل دخول

    const userBtn = document.getElementById("userBtn");

    userBtn.addEventListener("click", function () {

        if(isLoggedIn){

            window.location.href = "profile.php";

        }

        else{

            window.location.href = "login.php";

        }

    });

</script>
</body>
</html>
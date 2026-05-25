<?php
session_start();
include "db.php";


$conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "animalia_db"
);


if (!$conn) {
    die("Connection Failed");
}


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

                    <a href="p1.php#categories">
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
                    <a href="contact.php" class="active">
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

            <a href="profile.php" class="icon-btn" id="userBtn">

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
            <h3>About</h3>

            <a href="#">Privacy Policy</a>

            <a href="#">Terms & Conditions</a>

            <a href="#">Promotional Offers</a>

        </div>

        <div class="footer-box">

            <h3>Help</h3>

            <a href="contact.php">Customer Help</a>

            <a href="contact.php">Contact Us</a>

            <!--            <a href="#">Refund & Returns</a>-->

        </div>
        <div class="footer-box">

            <h3>Follow</h3>

            <a href="https://instagram.com">Instagram</a>

            <a href="https://tiktok.com">TikTok</a>

            <a href="https://facebook.com">Facebook</a>

            <a href="https://twitter.com">Twitter</a>

        </div>

    </div>

    <div class="footer-bottom">

        © 2026 Animalia Pet Store — All Rights Reserved

    </div>

</footer>
<script>

    const searchInput =
        document.querySelector(".search-box input");

    searchInput.addEventListener("keypress", function(e){

        if(e.key === "Enter"){

            const value =
                searchInput.value.toLowerCase();

            // CAT

            if(value.includes("cat food") || value.includes("cat dry food") || value.includes("dry food")){

                window.location.href =
                    "cat-food.php#dry-food";

            }
            else if(
                value.includes("cat wet food")
            ){

                window.location.href =
                    "cat-food.php#wet-food";

            }

            else if(
                value.includes("cat treat") ||
                value.includes("cat treats")
            ){

                window.location.href =
                    "cat-food.php#cat-treats";

            }
            else if(
                value.includes("cat toy") ||
                value.includes("cat toys")
            ){

                window.location.href = "cat-toys.php";

            }

            else if(
                value.includes("cat collar") ||
                value.includes("cat collars")
            ){

                window.location.href = "cat-collars.php";

            }

            else if(
                value.includes("carrier") ||
                value.includes("travel bag") ||
                value.includes("cat bag") ||
                value.includes("cat carrier")
            ){

                window.location.href =
                    "cat-beds.php#cat-carriers";

            }
            else if(
                value.includes("cat tree") ||
                value.includes("cat bed") ||
                value.includes("cat beds")
            ){

                window.location.href =
                    "cat-beds.php#cat-beds";

            }

            else if(
                value.includes("cat litter")
            ){

                window.location.href = "cat-litter.php";

            }

            else if(
                value.includes("litter box") ||
                value.includes("cat litter box")
            ){

                window.location.href = "cat-litter.php#products";

            }
            else if(
                value.includes("food bowl") ||
                value.includes("food bowls") ||
                value.includes("cat bowl") ||
                value.includes("cat bowls")
            ){

                window.location.href =
                    "cat-bowls.php#food-bowls";

            }
            else if(
                value.includes("water dispenser") ||
                value.includes("water dispensers") ||
                value.includes("water bowl") ||
                value.includes("water bowls")
            ){

                window.location.href =
                    "cat-bowls.php#water-dispensers";

            }
            else if(
                value.includes("cat clothes")
            ){

                window.location.href = "cat-collars.php";

            }

            else if(value.includes("cat")){

                window.location.href = "cat.php";

            }

            // DOG

            else if(
                value.includes("dog food")||
                value.includes("dog dry food")
            ){

                window.location.href =
                    "dog-food.php#dog-dry-food";

            }
            else if(
                value.includes("dog wet food")
            ){

                window.location.href =
                    "dog-food.php#dog-wet-food";

            }

            else if(
                value.includes("dog treats") ||
                value.includes("treats")
            ){

                window.location.href =
                    "dog-food.php#dog-treats";

            }

            else if(
                value.includes("dog toy") ||
                value.includes("dog toys")
            ){

                window.location.href = "dog-toys.php";

            }

            else if(
                value.includes("dog collar") ||
                value.includes("dog collars")
            ){

                window.location.href = "dog-collars.php";

            }
            else if(
                value.includes("dog bed") ||
                value.includes("dog beds")
            ){
                window.location.href =
                    "dog-beds.php#dog-beds";
            }
            else if(
                value.includes("dog carrier") ||
                value.includes("dog carriers") ||
                value.includes("dog bag") ||
                value.includes("travel bag")
            ){
                window.location.href =
                    "dog-beds.php#dog-carriers";
            }
            else if(
                value.includes("dog clothes")
            ){
                window.location.href = "dog-clothes.php";
            }
            else if(value.includes("dog")){
                window.location.href = "dog.php";
            }
            //BIRD
            else if(
                value.includes("bird cage") ||
                value.includes("bird cages") ||
                value.includes("bird nests") ||
                value.includes("nest")
            ){
                window.location.href = "bird-cages.php";
            }
            else if(
                value.includes("bird food") ||
                value.includes("bird snacks")
            ){
                window.location.href = "bird-food.php";
            }
            else if(
                value.includes("bird perch") ||
                value.includes("bird perches") ||
                value.includes("bird stand") ||
                value.includes("bird swing")
            ){
                window.location.href = "bird-perches.php";
            }
            else if(
                value.includes("bird accessory") ||
                value.includes("bird feeder") ||
                value.includes("bird water dispenser") ||
                value.includes("bird bath tub") ||
                value.includes("bird accessories")
            ){
                window.location.href = "bird-accessories.php";
            }
            else if(value.includes("bird")){
                window.location.href = "bird.php";
            }
            //FISH
            else if(
                value.includes("fish food")
            ){
                window.location.href = "fish-food.php#fish-food";
            }
            else if(
                value.includes("filters") ||
                value.includes("fish filter") ||
                value.includes("tank filter")
            ){

                window.location.href =
                    "fish-filter.php#fish-filters";

            }
            else if(
                value.includes("fish tank") ||
                value.includes("fish bowls") ||
                value.includes("aquarium")
            ){
                window.location.href = "fish-tank.php#fish-tanks";
            }
            else if(
                value.includes("lights") ||
                value.includes("lighting")||
                value.includes("tank lights") ||
                value.includes("fish decor") ||
                value.includes("tank decorations") ||
                value.includes("decorations")
            ){
                window.location.href = "fish-decoration.php#fish-decor";
            }
            // NOT FOUND
            else{

                alert("No matching category found!");
            }
        }
    });
</script>
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
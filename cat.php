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

    <title>Cat Products</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="style.css">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

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

        /* =========================
           PAGE TITLE
        ========================= */

        .page-title{
            text-align:center;
            font-size:60px;
            margin:60px 0;
            color:#3e2414;
        }

        /* =========================
           DROPDOWN
        ========================= */

        .dropdown-menu{
            position:absolute;
            top:160%;
            left:50%;
            transform:translateX(-50%);
            background:white;
            min-width:240px;
            border-radius:25px;
            padding:18px 0;
            box-shadow:0 15px 40px rgba(0,0,0,.08);

            opacity:0;
            visibility:hidden;

            transition:.3s;
            z-index:999;
        }

        .dropdown:hover .dropdown-menu{
            opacity:1;
            visibility:visible;
            top:140%;
        }

        .dropdown-menu li{
            width:100%;
        }

        .dropdown-menu li a{
            display:block;
            width:100%;
            padding:16px 30px;
            text-align:center;
        }

        .dropdown-menu li a::after{
            display:none;
        }

        .dropdown-menu li a:hover{
            background:#f8f3ed;
        }

        /* =========================
           CATEGORIES
        ========================= */

        .categories{
            width:90%;
            max-width:1200px;
            margin:auto;
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:40px;
            padding-bottom:80px;
        }
        /* CARD */
        .category-card{
            background:white;
            border-radius:35px;
            overflow:hidden;
            text-decoration:none;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,.06);
            transition:.4s;
            position:relative;
        }
        .category-card:hover{
            transform:translateY(-10px);
        }
        /* IMAGE */
        .img-box{
            height:320px;
            background:linear-gradient(135deg,#f3e2d1,#f8f3ed);
            display:flex;
            align-items:center;
            justify-content:center;
            overflow:hidden;
        }

        .img-box img{
            width:260px;
            height:260px;
            object-fit:contain;
            transition:.4s;
        }
        .category-card:hover .img-box img{
            transform:scale(1.08);
        }
        /* TEXT */
        .category-card h2{
            font-size:34px;
            margin-top:25px;
            color:#4b3527;
        }
        .category-card p{
            color:#8b5e3c;
            font-size:18px;
            margin:15px 0 35px;
        }
        /* =========================
           BACK BUTTON
        ========================= */
        .back-btn{
            display:flex;
            align-items:center;
            justify-content:center;
            width:180px;
            margin:20px auto 50px;
            padding:18px;
            border-radius:999px;
            background:linear-gradient(to right,#4b3527,#8b5e3c);
            color:white;
            text-decoration:none;
            font-size:18px;
            font-weight:600;
            transition:.3s;
        }
        .back-btn:hover{
            transform:translateY(-5px);
        }
        /* =========================
           RESPONSIVE
        ========================= */
        @media(max-width:900px){

            .categories{
                grid-template-columns:1fr;
            }

            .page-title{
                font-size:45px;
            }
        }
        @media(max-width:600px){
            .img-box{
                height:250px;
            }
            .img-box img{
                width:200px;
                height:200px;
            }
            .category-card h2{
                font-size:28px;
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
        <a href="https://facebook.com"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://instagram.com"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://twitter.com"><i class="fa-brands fa-twitter"></i></a>
    </div>
</div>
<!-- =========================
     HEADER
========================= -->
<header class="header">
    <div class="container header-content">
        <!-- LOGO -->
        <div class="logo">
            <img src="imgs/logo.png"
                 alt="Animalia Logo">
        </div>
        <!-- NAVBAR -->
        <nav class="navbar">
            <ul>
                <li>
                    <a href="p1.php">Home</a>
                </li>
                <li class="dropdown">
                    <a href="p1.php#categories">Store
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
                    <a href="about.html">About</a>
                </li>
                <li>
                    <a href="contact.php">Contact Us</a>
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
     PAGE TITLE
========================= -->
<h1 class="page-title">Cat Products</h1>
<!-- =========================
     CATEGORIES
========================= -->

<div class="categories">

    <a href="cat-food.php"
       class="category-card">

        <div class="img-box">

            <img src="imgs/cat food.png"
                 alt="Cat Food">

        </div>

        <h2>
            Cat Food
        </h2>

        <p>
            Dry • Wet • Treats
        </p>

    </a>

    <a href="cat-supplies.php"
       class="category-card">

        <div class="img-box">

            <img src="imgs/cat supp.jfif"
                 alt="Cat Supplies">

        </div>

        <h2>
            Cat Supplies
        </h2>

        <p>
            Toys • Beds • Boxes • Collars
        </p>

    </a>
</div>
<!-- BACK BUTTON -->
<a href="p1.php" class="back-btn">⬅ Back</a>
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
            <a href="contact.php">Customer Help</a>
            <a href="contact.php">Contact Us</a>
<!--            <a href="#">Refund & Returns</a>-->
        </div>
        <!-- FOLLOW -->
        <div class="footer-box">
            <h3>Follow</h3>
            <a href="https://instagram.com">Instagram</a>
            <a href="https://tiktok.com">TikTok</a>
            <a href="https://facebook.com">Facebook</a>
            <a href="https://twitter.com">Twitter</a>
        </div>
    </div>
    <!-- FOOTER BOTTOM -->
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
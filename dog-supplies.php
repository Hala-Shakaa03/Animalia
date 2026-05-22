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
    <title>Dog Supplies</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:'Poppins',sans-serif;
        background:#f8f3ed;
        color:#4b3527;
        overflow-x:hidden;
    }

    /* =========================
       PAGE TITLE
    ========================= */

    h1{

        text-align:center;

        margin:60px 0;

        font-size:64px;

        color:#4b3527;

        font-weight:800;

        letter-spacing:1px;
    }

    /* =========================
       CATEGORIES
    ========================= */

    .categories{

        width:92%;

        max-width:1450px;

        margin:auto;

        display:grid;

        grid-template-columns:
    repeat(auto-fit,minmax(300px,1fr));

        gap:35px;

        margin-bottom:80px;
    }

    /* =========================
       CATEGORY CARD
    ========================= */

    .category-card{

        position:relative;

        background:rgba(255,255,255,.92);

        backdrop-filter:blur(12px);

        border-radius:35px;

        overflow:hidden;

        text-decoration:none;

        color:#4b3527;

        box-shadow:
                0 10px 30px rgba(0,0,0,.06);

        transition:.4s;
    }

    .category-card:hover{

        transform:
                translateY(-12px)
                scale(1.02);

        box-shadow:
                0 20px 45px rgba(139,94,60,.18);
    }

    /* =========================
       IMAGE BOX
    ========================= */

    .img-box{

        width:100%;

        height:300px;

        background:
                linear-gradient(
                        135deg,
                        #f7efe7,
                        #efe2d2
                );

        display:flex;

        justify-content:center;

        align-items:center;

        overflow:hidden;
    }

    .img-box img{

        width:112%;

        height:112%;

        object-fit:contain;

        transition:.5s;
    }

    .category-card:hover img{

        transform:
                scale(1.1)
                rotate(-2deg);
    }

    /* =========================
       CATEGORY TEXT
    ========================= */

    .category-card h2{

        font-size:34px;

        text-align:center;

        margin-top:28px;

        margin-bottom:12px;

        font-weight:800;
    }

    .category-card p{

        text-align:center;

        color:#8b5e3c;

        font-size:18px;

        margin-bottom:38px;

        font-weight:500;

        line-height:1.7;
    }

    /* =========================
       BACK BUTTON
    ========================= */

    .back-btn{

        width:230px;

        display:flex;

        justify-content:center;

        align-items:center;

        margin:0 auto 90px;

        text-decoration:none;

        background:
                linear-gradient(
                        to right,
                        #5b3822,
                        #9b6a43
                );

        color:white;

        padding:17px;

        border-radius:999px;

        font-size:18px;

        font-weight:700;

        transition:.35s;
    }

    .back-btn:hover{

        transform:
                translateY(-4px);

        box-shadow:
                0 10px 25px rgba(139,94,60,.25);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width:992px){

        h1{
            font-size:50px;
        }

        .categories{
            grid-template-columns:
        repeat(auto-fit,minmax(250px,1fr));
        }
    }

    @media(max-width:768px){

        h1{
            font-size:40px;
        }

        .categories{
            grid-template-columns:1fr;
        }

        .img-box{
            height:240px;
        }

        .category-card h2{
            font-size:28px;
        }

        .category-card p{
            font-size:16px;
        }
    }
</style>
<body>

<div class="topbar">
    <div class="topbar-left">
        <i class="fa-solid fa-phone"></i>+970 59 876 5432</div>
    <div class="topbar-center">
        <i class="fa-solid fa-truck"></i>Free delivery on orders over ₪100</div>
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
            <img src="imgs/logo.png" alt="Animalia Logo">
        </div>
        <!-- NAVBAR -->
        <nav class="navbar">
            <ul>
                <li>
                    <a href="p1.php" class="active">Home</a>
                </li>
                <li class="dropdown">
                    <a href="p1.php#categories">Store
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="cat.php">Cats</a></li>
                        <li><a href="dog.php">Dogs</a></li>
                        <li><a href="bird.php">Birds</a></li>
                        <li><a href="fish.php">Aquarium</a></li>
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

<h1 style="text-align:center; margin:30px;">Dog Supplies</h1>

<div class="categories">

    <a href="dog-toys.php" class="category-card">
        <div class="img-box">
            <img src="imgs/dog toy.png" alt="dog toy">
        </div>
        <h2>Dog Toys</h2>
        <p>Balls • Plush • Bones</p>
    </a>

    <a href="dog-collars.php" class="category-card">
        <div class="img-box">
            <img src="imgs/dog collar.jfif" alt="dog collar">
        </div>
        <h2>Collars & Leashes</h2>
        <p>With Leash • Without • Training</p>
    </a>

    <a href="dog-bowls.php" class="category-card">
        <div class="img-box">
            <img src="imgs/dog bowl.jfif" alt="dog bowl">
        </div>
        <h2>Bowls & Feeders </h2>
        <p>Food Bowls • Water Dispensers</p>
    </a>
    <a href="dog-beds.php" class="category-card">
        <div class="img-box">
            <img src="imgs/dog bed.jfif" alt="dog bed">
        </div>
        <h2>Beds & Carriers</h2>
        <p>Soft Beds • Carriers </p>
    </a>
</div>

<a href="dog.php" class="back-btn">⬅ Back</a>

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
            <!--            <a href="contact.php">Refund & Returns</a>-->
        </div>
        <!-- FOLLOW -->
        <div class="footer-box">
            <h3>Follow</h3>
            <a href="https://instagram.com">Instagram</a>
            <a href="https://tiktok.com">TikTok</a>
            <a href="https://facebook.com">Facebook</a>
            <a href="https://twitter.com">Twitter</a>
        </div>
        <!-- PAYMENT -->
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

</body>
</html>
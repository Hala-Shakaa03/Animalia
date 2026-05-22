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

    <title>
        Bird Accessories
    </title>

    <!-- CSS -->

    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- GOOGLE FONT -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
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
        color:#3e2f26;
        overflow-x:hidden;
    }

    /* =========================
       HERO
    ========================= */

    .bird-hero{
        width:90%;
        margin:40px auto 70px;
    }

    .bird-hero-content{

        background:
                linear-gradient(
                        135deg,
                        rgba(61,32,15,.95),
                        rgba(139,94,60,.85)
                );

        border-radius:40px;

        padding:60px;

        display:flex;

        align-items:center;

        justify-content:space-between;

        gap:40px;

        overflow:hidden;

        position:relative;
    }

    .bird-hero-content::before{

        content:"";

        position:absolute;

        width:400px;

        height:400px;

        border-radius:50%;

        background:rgba(255,255,255,.05);

        top:-120px;

        right:-120px;
    }

    .bird-hero-text{
        z-index:2;
        color:white;
    }

    .bird-tag{

        background:#f3c98b;

        color:#3e2414;

        padding:10px 22px;

        border-radius:999px;

        font-weight:700;

        display:inline-block;

        margin-bottom:25px;
    }

    .bird-hero-text h1{

        font-size:65px;

        line-height:1.1;

        margin-bottom:20px;

        font-weight:800;
    }

    .bird-hero-text p{

        font-size:20px;

        color:#f4e6d8;

        line-height:1.8;

        max-width:600px;
    }

    .bird-hero-image img{

        width:420px;

        position:relative;

        z-index:2;

        animation:float 4s ease-in-out infinite;
    }

    @keyframes float{

        0%,100%{
            transform:translateY(0);
        }

        50%{
            transform:translateY(-15px);
        }
    }

    /* =========================
       SECTION TITLE
    ========================= */

    .section-title{

        text-align:center;

        font-size:42px;

        color:#3e2414;

        margin-bottom:45px;

        font-weight:800;
    }

    /* =========================
       PRODUCTS SECTION
    ========================= */

    .bird-products-section{

        width:90%;

        margin:auto;

        padding-bottom:90px;
    }

    /* =========================
       PRODUCTS GRID
    ========================= */

    .products{

        display:grid;

        grid-template-columns:
    repeat(auto-fit,minmax(280px,1fr));

        gap:32px;
    }

    /* =========================
       PRODUCT CARD
    ========================= */

    .product-card{

        background:white;

        border-radius:32px;

        padding:22px;

        text-align:center;

        box-shadow:
                0 10px 25px rgba(0,0,0,.05);

        transition:.4s;

        display:flex;

        flex-direction:column;

        justify-content:space-between;

        min-height:600px;
    }

    .product-card:hover{

        transform:
                translateY(-10px);

        box-shadow:
                0 18px 35px rgba(0,0,0,.08);
    }

    /* =========================
       IMAGE BOX
    ========================= */

    .img-box{

        height:250px;

        border-radius:28px;

        background:
                linear-gradient(
                        135deg,
                        #f3e2d1,
                        #faf6f1
                );

        display:flex;

        align-items:center;

        justify-content:center;

        overflow:hidden;

        margin-bottom:20px;
    }

    .img-box img{

        width:85%;

        height:85%;

        object-fit:contain;

        transition:.4s;
    }

    .product-card:hover img{

        transform:scale(1.08);
    }

    /* =========================
       PRODUCT NAME
    ========================= */

    .product-card h3{

        font-size:23px;

        line-height:1.5;

        margin-bottom:12px;

        color:#4b3527;

        min-height:70px;
    }

    /* =========================
       PRICE
    ========================= */

    .price{

        font-size:32px;

        font-weight:800;

        color:#8b5e3c;

        margin-bottom:20px;
    }

    /* =========================
       SIZES
    ========================= */

    .sizes{

        display:flex;

        justify-content:center;

        gap:10px;

        margin-bottom:20px;

        flex-wrap:wrap;
    }

    .size{

        padding:10px 18px;

        border-radius:999px;

        background:#f3ebe2;

        color:#4b3527;

        font-size:14px;

        font-weight:600;

        cursor:pointer;

        transition:.3s;
    }

    .size:hover,
    .size.active{

        background:#8b5e3c;

        color:white;
    }

    /* =========================
       QUANTITY
    ========================= */

    .quantity{
        margin-bottom:20px;
    }

    .quantity label{

        display:block;

        margin-bottom:10px;

        font-size:15px;

        font-weight:600;

        color:#6f5a4d;
    }

    .quantity input{

        width:90px;

        height:45px;

        border:none;

        outline:none;

        border-radius:14px;

        background:#f7efe7;

        text-align:center;

        font-size:17px;

        font-weight:600;

        color:#4b3527;
    }

    /* =========================
       BUTTON
    ========================= */

    .product-card button{

        width:100%;

        border:none;

        background:
                linear-gradient(
                        to right,
                        #4b3527,
                        #8b5e3c
                );

        color:white;

        padding:15px;

        border-radius:999px;

        font-size:16px;

        font-weight:700;

        cursor:pointer;

        transition:.3s;

        margin-top:auto;
    }

    .product-card button:hover{

        transform:translateY(-4px);

        opacity:.95;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width:1100px){

        .bird-hero-content{
            flex-direction:column;
            text-align:center;
        }

        .bird-hero-text p{
            margin:auto;
        }

        .products{
            grid-template-columns:
        repeat(2,1fr);
        }
    }

    @media(max-width:700px){

        .bird-hero-content{
            padding:40px 25px;
        }

        .bird-hero-text h1{
            font-size:42px;
        }

        .bird-hero-image img{
            width:260px;
        }

        .products{
            grid-template-columns:1fr;
        }

        .section-title{
            font-size:34px;
        }

        .product-card{
            min-height:auto;
        }
    }

    /* =========================
           BACK BUTTON
        ========================= */

    .back-btn{

        width:230px;

        display:flex;

        justify-content:center;

        align-items:center;

        margin:20px auto 90px;

        text-decoration:none;

        background:
                linear-gradient(
                        to right,
                        #4b3527,
                        #8b5e3c
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

</style>
</head>

<body>

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

        <a href="https://facebook.com">
            <i class="fa-brands fa-facebook-f"></i>
        </a>

        <a href="https://instagram.com">
            <i class="fa-brands fa-instagram"></i>
        </a>

        <a href="https://twitter.com">
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
                    <a href="p1.php" class="active">Home</a>
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
                    <a href="about.html">About</a>
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
     HERO SECTION
========================= -->
<!---->
<!--<section class="bird-hero">-->
<!---->
<!--    <div class="bird-hero-content">-->
<!---->
<!--        <div class="bird-hero-text">-->
<!---->
<!--            <span class="bird-tag">-->
<!--                Bird Accessories-->
<!--            </span>-->
<!---->
<!--            <h1>-->
<!--                Feeders • Drinkers • Baths-->
<!--            </h1>-->
<!---->
<!--            <p>-->
<!--                Premium accessories for your lovely birds-->
<!--                with elegant designs and high quality.-->
<!--            </p>-->
<!---->
<!--        </div>-->
<!---->
<!--        <div class="bird-hero-image">-->
<!---->
<!--            <img src="imgs/birdd.png"-->
<!--                 alt="Bird">-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->

<!--</section>-->

<!-- =========================
     PRODUCTS
========================= -->

<section class="bird-products-section">

    <h2 class="section-title">
        Shop Accessories
    </h2>

    <div class="products">

        <!-- PRODUCT -->

        <div class="product-card">

            <div class="img-box">

                <img src="imgs/Transparent Plastic Bird Feeder – Set of 2.jpeg"
                     alt="Bird Feeder">

            </div>

            <h3>
                Plastic Bird Feeder Set
            </h3>

            <p class="price">
                ₪4
            </p>

            <div class="quantity">

                <label>
                    Quantity
                </label>

                <input type="number"
                       value="1"
                       min="1">

            </div>

            <button>
                Add to Cart
            </button>

        </div>

        <!-- PRODUCT -->

        <div class="product-card">

            <div class="img-box">

                <img src="imgs/Plastic Bird Egg Holder – Set of 2.jpg"
                     alt="Bird Egg Holder">

            </div>

            <h3>
                Bird Egg Holder
            </h3>

            <p class="price">
                ₪4
            </p>

            <div class="quantity">

                <label>
                    Quantity
                </label>

                <input type="number"
                       value="1"
                       min="1">

            </div>

            <button>
                Add to Cart
            </button>

        </div>

        <!-- PRODUCT -->

        <div class="product-card">

            <div class="img-box">

                <img src="imgs/Round Plastic Bird Feeder.jpeg"
                     alt="Round Bird Feeder">

            </div>

            <h3>
                Round Bird Feeder
            </h3>

            <p class="price">
                ₪3
            </p>

            <div class="quantity">

                <label>
                    Quantity
                </label>

                <input type="number"
                       value="1"
                       min="1">

            </div>

            <button>
                Add to Cart
            </button>

        </div>

        <!-- PRODUCT -->

        <div class="product-card">

            <div class="img-box">

                <img src="imgs/Hanging Plastic Bird Feeder.jpg"
                     alt="Hanging Bird Feeder">

            </div>

            <h3>
                Hanging Bird Feeder
            </h3>

            <p class="price">
                ₪5
            </p>

            <div class="quantity">

                <label>
                    Quantity
                </label>

                <input type="number"
                       value="1"
                       min="1">

            </div>

            <button>
                Add to Cart
            </button>

        </div>

        <!-- PRODUCT -->

        <div class="product-card">

            <div class="img-box">

                <img src="imgs/Double Compartment Bird Feeder.png"
                     alt="Double Bird Feeder">

            </div>

            <h3>
                Double Bird Feeder
            </h3>

            <p class="price">
                ₪10
            </p>

            <div class="quantity">

                <label>
                    Quantity
                </label>

                <input type="number"
                       value="1"
                       min="1">

            </div>

            <button>
                Add to Cart
            </button>

        </div>

        <!-- PRODUCT WITH SIZES -->

        <div class="product-card">

            <div class="img-box">

                <img src="imgs/Plastic Bird Water Dispenser – 100ml.png"
                     alt="Water Dispenser">

            </div>

            <h3 class="product-name"
                data-base="Bird Water Dispenser">

                Bird Water Dispenser - 100ml

            </h3>

            <p class="price">
                ₪8
            </p>

            <div class="sizes">

                <span class="size active"
                      data-name="100ml"
                      data-price="8"
                      data-img="imgs/Plastic Bird Water Dispenser – 100ml.png">

                    100ml

                </span>

                <span class="size"
                      data-name="200ml"
                      data-price="12"
                      data-img="imgs/Plastic Bird Water Dispenser – 200ml.png">

                    200ml

                </span>

            </div>

            <div class="quantity">

                <label>
                    Quantity
                </label>

                <input type="number"
                       value="1"
                       min="1">

            </div>

            <button>
                Add to Cart
            </button>

        </div>

        <!-- PRODUCT -->

        <div class="product-card">

            <div class="img-box">

                <img src="imgs/Transparent Hanging Bird Bath.jfif"
                     alt="Bird Bath">

            </div>

            <h3>
                Hanging Bird Bath
            </h3>

            <p class="price">
                ₪12
            </p>

            <div class="quantity">

                <label>
                    Quantity
                </label>

                <input type="number"
                       value="1"
                       min="1">

            </div>

            <button>
                Add to Cart
            </button>

        </div>

        <!-- PRODUCT -->

        <div class="product-card">

            <div class="img-box">

                <img src="imgs/Covered Bird Bath Tub.jfif"
                     alt="Bird Bath Tub">

            </div>

            <h3>
                Covered Bird Bath Tub
            </h3>

            <p class="price">
                ₪15
            </p>

            <div class="quantity">

                <label>
                    Quantity
                </label>

                <input type="number"
                       value="1"
                       min="1">

            </div>

            <button>
                Add to Cart
            </button>

        </div>

    </div>

</section>
<a href="bird.php" class="back-btn">⬅ Back</a>
<!-- =========================
     SCRIPT
========================= -->

<script>

    document.querySelectorAll(".product-card").forEach(card => {

        const sizes = card.querySelectorAll(".size");
        const price = card.querySelector(".price");
        const img = card.querySelector("img");
        const name = card.querySelector(".product-name");

        sizes.forEach(btn => {

            btn.addEventListener("click", () => {

                sizes.forEach(b => b.classList.remove("active"));

                btn.classList.add("active");

                if(price && btn.dataset.price){

                    price.textContent =
                        "₪" + btn.dataset.price;

                }

                if(img && btn.dataset.img){

                    img.src =
                        btn.dataset.img;

                }

                if(name && btn.dataset.name){

                    name.textContent =
                        name.dataset.base + " - " +
                        btn.dataset.name;

                }

            });

        });

    });

</script>

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

    /* =========================
       ADD TO CART - BACKEND
    ========================= */

    document.querySelectorAll(".product-card button")
        .forEach(function(button){

            button.setAttribute("type", "button");

            button.addEventListener("click", function(){

                const card = button.closest(".product-card");

                const name = card.querySelector("h3").innerText;

                const priceText = card.querySelector(".price").innerText;

                const price = parseFloat(priceText.replace("₪",""));

                const image = card.querySelector("img").getAttribute("src");

                const quantity = parseInt(card.querySelector(".quantity input").value);

                fetch("add_to_cart.php", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },

                    body:
                        "name=" + encodeURIComponent(name)
                        + "&price=" + price
                        + "&image=" + encodeURIComponent(image)
                        + "&quantity=" + quantity
                })

                    .then(response => response.text())

                    .then(data => {

                        data = data.trim();

                        if(data === "login"){

                            alert("Please login first!");
                            window.location.href = "login.php";

                        }else{

                            alert("Product added to cart!");

                            const cartNumber =
                                document.querySelector(".cart-number");

                            if(cartNumber){

                                let currentNumber =
                                    parseInt(cartNumber.textContent || 0);

                                cartNumber.textContent =
                                    currentNumber + quantity;
                            }
                        }

                    });

            });

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
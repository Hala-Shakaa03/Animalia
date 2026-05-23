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
    <title>Dog Food</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">    <style>
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

        .page-title{

            text-align:center;

            font-size:64px;

            margin:60px 0 35px;

            color:#4b3527;

            font-weight:800;

            letter-spacing:1px;
        }

        /* =========================
           SECTION
        ========================= */

        .section{

            width:92%;

            max-width:1550px;

            margin:0 auto 80px;
        }

        /* SECTION TITLES */

        .section h2{

            font-size:38px;

            color:#5b3822;

            margin-bottom:30px;

            font-weight:800;

            position:relative;

            padding-left:18px;
        }

        .section h2::before{

            content:"";

            position:absolute;

            left:0;

            top:4px;

            width:6px;

            height:40px;

            border-radius:20px;

            background:
                    linear-gradient(
                            to bottom,
                            #8b5e3c,
                            #c58b5c
                    );
        }

        /* =========================
           PRODUCTS GRID
        ========================= */

        .products{

            display:grid;

            grid-template-columns:
    repeat(auto-fit,minmax(280px,1fr));

            gap:35px;
        }

        /* =========================
           PRODUCT CARD
        ========================= */

        .product-card{

            position:relative;

            background:rgba(255,255,255,.92);

            backdrop-filter:blur(12px);

            border-radius:35px;

            padding:22px;

            text-align:center;

            overflow:hidden;

            border:1px solid rgba(255,255,255,.4);

            box-shadow:
                    0 10px 30px rgba(0,0,0,.06);

            transition:.4s;

            display:flex;

            flex-direction:column;

            justify-content:space-between;

            min-height:560px;
        }

        .product-card:hover{

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

            height:250px;

            border-radius:28px;

            background:
                    linear-gradient(
                            135deg,
                            #f7efe7,
                            #efe2d2
                    );

            display:flex;

            align-items:center;

            justify-content:center;

            overflow:hidden;

            margin-bottom:22px;
        }

        .img-box img{

            width:85%;

            height:85%;

            object-fit:contain;

            transition:.5s;
        }

        .product-card:hover img{

            transform:
                    scale(1.1)
                    rotate(-2deg);
        }

        /* =========================
           PRODUCT NAME
        ========================= */

        .product-card h3{

            font-size:22px;

            line-height:1.5;

            color:#4b3527;

            margin-bottom:14px;

            min-height:76px;

            font-weight:700;
        }

        /* =========================
           PRICE
        ========================= */

        .price{

            font-size:34px;

            font-weight:800;

            color:#8b5e3c;

            margin-bottom:20px;
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

            font-size:18px;

            font-weight:600;

            color:#4b3527;

            transition:.3s;
        }

        .quantity input:focus{

            background:#efe2d2;
        }

        /* =========================
           BUTTON
        ========================= */

        .product-card button{

            width:100%;

            border:none;

            padding:16px;

            border-radius:999px;

            background:
                    linear-gradient(
                            to right,
                            #5b3822,
                            #9b6a43
                    );

            color:white;

            font-size:16px;

            font-weight:700;

            cursor:pointer;

            transition:.35s;

            margin-top:auto;

            letter-spacing:.5px;
        }

        .product-card button:hover{

            transform:
                    translateY(-4px);

            box-shadow:
                    0 10px 25px rgba(139,94,60,.25);
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

            .page-title{
                font-size:50px;
            }

            .section h2{
                font-size:32px;
            }

            .products{
                grid-template-columns:
        repeat(auto-fit,minmax(240px,1fr));
            }
        }

        @media(max-width:768px){

            .page-title{
                font-size:40px;
            }

            .section h2{
                font-size:28px;
            }

            .products{
                grid-template-columns:1fr;
            }

            .img-box{
                height:220px;
            }

            .product-card{
                min-height:auto;
            }
        }
    </style>
</head>

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

<h1 class="page-title">Dog Food</h1>

<!-- DRY FOOD -->
<section class="section" id="dog-dry-food">
    <h2>Dry Food</h2>

    <div class="products">

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/croque_adult_dog_lamb_3_kg.jpg" alt="Croque Lamb Dry Food 3kg">
            </div>

            <h3>Croque Lamb Dry Food 3kg</h3>
            <p class="price">₪35</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>


        <div class="product-card">

            <div class="img-box">
                <img src="imgs/fincsi_adult_dog_chicken_3_kg.png" alt="Fincsi Chicken Dry Food 3kg">
            </div>

            <h3>Fincsi Chicken Dry Food 3kg</h3>
            <p class="price">₪45</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/fincsi_adult_dog_beef_3_kg.jpg" alt="Fincsi Beef Dry Food 3kg">
            </div>

            <h3>Fincsi Beef Dry Food 3kg</h3>
            <p class="price">₪45</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/dog_dry_12kg.png" alt="Pedigree Dry Food 12kg">
            </div>

            <h3>Pedigree Poultry & Vegetables Dry Food 12kg</h3>
            <p class="price">₪120</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Puppy_dry_3kg.jpeg" alt="Pedigree Puppy Dry Food 3kg">
            </div>

            <h3>Pedigree Puppy Dry Food 3kg</h3>
            <p class="price">₪45</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Puppy_dry_Poultry_and_Vegetables_12kg.jpeg" alt="Pedigree Puppy Dry Food 12kg">
            </div>

            <h3>Pedigree Poultry & Vegetables Puppy Dry Food  12kg</h3>
            <p class="price">₪120</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
    </div>
</section>



<!-- WET FOOD -->
<section class="section" id="dog-wet-food">
    <h2>Wet Food</h2>

    <div class="products">

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Simba_wet_adult.jpeg" alt="Simba Wet Food">
            </div>

            <h3>Simba Wet Food</h3>
            <p class="price">₪4</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/C_Large_Puppy_Wet_TSiG.jbeg.webp" alt="Puppy Wet Food">
            </div>

            <h3>Royal Canin Puppy Wet Food</h3>
            <p class="price">₪6</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Pedigree_Wet_Food_Beef.png" alt="Pedigree Beef Wet Food">
            </div>

            <h3>Pedigree Beef Wet Food</h3>
            <p class="price">₪5</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Pedigree_Puppy_wet_Food_Chicken_and_Beef.png" alt="Pedigree Chicken and Beef Puppy Wet Food">
            </div>

            <h3>Pedigree Chicken & Beef Puppy Wet Food</h3>
            <p class="price">₪5</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
    </div>
</section>



<!-- TREATS -->
<section class="section" id="dog-treats">
    <h2>Treats</h2>

    <div class="products">

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/peanut_butter_treats.webp" alt="Peanut Butter Treats">
            </div>

            <h3> Peanut Butter Biscuits</h3>
            <p class="price">₪10</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/softies-chicken-duck-dog-treats-scrumbles.webp" alt="Softies Chicken and Duck Treats">
            </div>

            <h3> Scrumbles Chicken and Duck Softies For Training</h3>
            <p class="price">₪15</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/chicken_and_milk_treats.png" alt="Puppy Chicken and Milk Air Dried Treats">
            </div>

            <h3> Puppy Chicken and Duck Air Dried Strapz</h3>
            <p class="price">₪15</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/wanpy_chicken_treats.png" alt="Wanpy Chicken and Jerky Sushi Treats">
            </div>

            <h3> Wanpy Chicken, Jerky and Codfish Sushi Treats </h3>
            <p class="price">₪10</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/wanpy_duck_treats.png" alt="Wanpy Duck and Jerky Stripes Treats">
            </div>

            <h3> Wanpy Duck and Jerky Stripes</h3>
            <p class="price">₪10</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/bones_2_15cm.png" alt="Two 12cm Bones ">
            </div>

            <h3> Two Bones - 12cm</h3>
            <p class="price">₪10</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                    <img src="imgs/small_bones_5_5cm.png" alt="Five 5cm Bones ">
            </div>

            <h3> Five Bones - 5cm</h3>
            <p class="price">₪12</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/healthy_bones_2_11cm.png" alt="Two 11cm Healthy Bones ">
            </div>

            <h3> Two Healthy Bones- 11cm</h3>
            <p class="price">₪12</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/healthy_bones_5_7cm.png" alt="Five 7cm Healthy Bones ">
            </div>

            <h3> Five Healthy Bones- 7cm</h3>
            <p class="price">₪15</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

    </div>
</section>

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
    </div>
    <!-- BOTTOM -->
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
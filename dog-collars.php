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
    <title>Collars and Clothes</title>
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

            font-size:60px;

            margin:60px 0;

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

            position:relative;
        }

        .img-box img{

            width:102%;

            height:105%;

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
                font-size:48px;
            }

            .products{
                grid-template-columns:
        repeat(auto-fit,minmax(240px,1fr));
            }
        }

        @media(max-width:768px){

            .page-title{
                font-size:38px;
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

<h1 class="page-title">Collars & Clothes</h1>

<section class="section">
    <div class="products">

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Black Studded Dog Collar – 50cm.jpeg" alt="Black Studded Dog Collar – 50cm">
            </div>
            <h3>Black Studded Dog Collar – 50cm </h3>
            <p class="price">₪10</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Black Dog Collar.jfif" alt="Black Dog Collar – 50cm">
            </div>
            <h3>Black Dog Collar – 50cm </h3>
            <p class="price">₪10</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Pink Dog Collar.jfif" alt="Pink Dog Collar – 50cm">
            </div>
            <h3>Pink Dog Collar – 50cm </h3>
            <p class="price">₪10</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Burgandy Dog Collar.jfif" alt="Burgandy Dog Collar – 50cm">
            </div>
            <h3>Burgundy Dog Collar – 50cm </h3>
            <p class="price">₪10</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Braided Dog Leash with Collar – 115cm.jpeg" alt="Braided Dog Leash with Collar – 115cm">
            </div>
            <h3>Braided Dog Leash with Collar – 115cm </h3>
            <p class="price">₪20</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Soft Handle Dog Leash – 120cm.jpeg" alt="Soft Handle Dog Leash – 120cm">
            </div>
            <h3>Soft Handle Dog Leash – 120cm</h3>
            <p class="price">₪20</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Pink Dog Harness & Leash Set.jpeg" alt="Pink Dog Harness & Leash Set">
            </div>
            <h3>Pink Dog Harness & Leash Set</h3>
            <p class="price">₪25</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Military Dog Harness & Leash Set.jpeg" alt="Military Dog Harness & Leash Set">
            </div>
            <h3>Military Dog Harness & Leash Set</h3>
            <p class="price">₪30</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Red Retractable Dog Leash – 3M.jpg" alt="Red Retractable Dog Leash – 3M">
            </div>
            <h3>Red Retractable Dog Leash – 3M</h3>
            <p class="price">₪15</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Pink Retractable Dog Leash.png" alt="Pink Retractable Dog Leash">
            </div>
            <h3>Pink Retractable Dog Leash - 3M</h3>
            <p class="price">₪15</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Automatic Dog Leash.png" alt="Automatic Dog Leash">
            </div>
            <h3>Automatic Dog Leash - 3M</h3>
            <p class="price">₪17</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Metal Dog Training Collar – 50cm.jpg" alt="Metal Dog Training Collar – 50cm">
            </div>
            <h3>Metal Dog Training Collar – 50cm</h3>
            <p class="price">₪12</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Metal Dog Chain Leash – 150cm.png" alt="Metal Dog Chain Leash – 150cm">
            </div>
            <h3>Metal Dog Chain Leash – 150cm</h3>
            <p class="price">₪20</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Heavy Duty Metal Dog Chain – 160cm.png" alt="Heavy Duty Metal Dog Chain – 160cm">
            </div>
            <h3>Heavy Duty Metal Dog Chain – 160cm</h3>
            <p class="price">₪25</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>


        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Knitted Dog Sweater.png" alt="Knitted Dog Sweater">
            </div>
            <h3>Knitted Dog Red Sweater</h3>
            <p class="price">₪15</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Soft Dog Hoodie.png" alt="Soft Dog Hoodie">
            </div>
            <h3>Soft Dog Gray Hoodie</h3>
            <p class="price">₪20</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Puffer Dog Jacket.png" alt="Puffer Dog Jacket">
            </div>
            <h3>Puffer Dog Purple Jacket</h3>
            <p class="price">₪30</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Waterproof Reflective Dog Coat.png" alt="Waterproof Reflective Dog Coat">
            </div>
            <h3>Waterproof Reflective Dog Red Coat</h3>
            <p class="price">₪35</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Pink Princess Dog Dress Set.png" alt="Pink Princess Dog Dress Set">
            </div>
            <h3>Pink Princess Dog Dress Set</h3>
            <p class="price">₪15</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

    </div>
</section>

<a href="dog-supplies.php" class="back-btn">⬅ Back</a>

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
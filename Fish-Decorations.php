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
    <title>Fish Tanks Decorations</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

        .page-title{
            text-align:center;
            font-size:55px;
            margin:50px 0;
            color:#4b3527;
            font-weight:800;
        }

        /* =========================
           SECTION
        ========================= */

        .section{
            width:92%;
            max-width:1450px;
            margin:auto;
        }

        /* =========================
           PRODUCTS GRID
        ========================= */

        .products{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(260px,1fr));

            gap:28px;

            margin-bottom:60px;
        }

        /* =========================
           PRODUCT CARD
        ========================= */

        .product-card{

            background:white;

            border-radius:30px;

            padding:18px;

            text-align:center;

            box-shadow:
                    0 8px 20px rgba(0,0,0,.07);

            transition:.35s;

            display:flex;

            flex-direction:column;

            justify-content:space-between;

            min-height:540px;
        }

        .product-card:hover{
            transform:translateY(-8px);
        }

        /* =========================
           IMAGE BOX
        ========================= */

        .img-box{

            width:100%;

            height:230px;

            border-radius:24px;

            background:#f5ede4;

            display:flex;

            align-items:center;

            justify-content:center;

            overflow:hidden;

            margin-bottom:18px;
        }

        .img-box img{

            width:100%;

            height:100%;

            object-fit:contain;

            transition:.4s;
        }

        .product-card:hover img{
            transform:scale(1.05);
        }

        /* =========================
           PRODUCT NAME
        ========================= */

        .product-card h3{

            font-size:20px;

            line-height:1.5;

            color:#4b3527;

            margin-bottom:12px;

            min-height:65px;
        }

        /* =========================
           PRICE
        ========================= */

        .price{

            font-size:28px;

            font-weight:700;

            color:#8b5e3c;

            margin-bottom:18px;
        }

        /* =========================
           SIZES
        ========================= */

        .sizes{

            display:flex;

            justify-content:center;

            gap:10px;

            margin-bottom:18px;

            flex-wrap:wrap;
        }

        .size{

            padding:8px 16px;

            border-radius:999px;

            background:#f5ede4;

            cursor:pointer;

            transition:.3s;

            font-size:14px;

            font-weight:600;
        }

        .size:hover{
            background:#d8c2ad;
        }

        .size.active{

            background:#8b5e3c;

            color:white;
        }

        /* =========================
           QUANTITY
        ========================= */

        .quantity{
            margin-bottom:18px;
        }

        .quantity label{

            display:block;

            margin-bottom:10px;

            font-size:15px;

            font-weight:600;

            color:#6f5a4d;
        }

        .quantity input{

            width:85px;

            height:42px;

            border:none;

            outline:none;

            border-radius:12px;

            background:#f5ede4;

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

            padding:14px;

            border-radius:999px;

            background:
                    linear-gradient(to right,#4b3527,#8b5e3c);

            color:white;

            font-size:16px;

            font-weight:700;

            cursor:pointer;

            transition:.3s;

            margin-top:auto;
        }

        .product-card button:hover{

            transform:translateY(-3px);

            opacity:.92;
        }

        /* =========================
           BACK BUTTON
        ========================= */

        .back-btn{

            width:210px;

            display:flex;

            justify-content:center;

            align-items:center;

            margin:20px auto 70px;

            text-decoration:none;

            background:#4b3527;

            color:white;

            padding:16px;

            border-radius:999px;

            font-size:18px;

            font-weight:600;

            transition:.3s;
        }

        .back-btn:hover{

            background:#8b5e3c;

            transform:translateY(-4px);
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width:992px){

            .page-title{
                font-size:45px;
            }

            .products{
                grid-template-columns:
                        repeat(auto-fit,minmax(230px,1fr));
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
                height:210px;
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

<h1 class="page-title">Tank Decorations</h1>
<section class="section" id="fish-decor">

    <div class="products">

        <!-- PRODUCT 1 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Aquarium Decorative Shells.png">
            </div>

            <h3 class="product-name"
                data-base="Decorative Shells">

                Decorative Shells - Mini

            </h3>

            <p class="price">₪10</p>

            <div class="sizes">

                <span class="size active"
                      data-name="Mini"
                      data-price="10"
                      data-img="imgs/Aquarium Decorative Shells.png">

                    Mini

                </span>

                <span class="size"
                      data-name="Small"
                      data-price="15"
                      data-img="imgs/Aquarium Decorative Small Shells.jfif">

                    Small

                </span>

                <span class="size"
                      data-name="Medium"
                      data-price="20"
                      data-img="imgs/Aquarium Decorative M Shells.jfif">

                    Medium

                </span>

            </div>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 2 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Aquarium_Gravel_Multi_Colour.webp">
            </div>

            <h3>Aquarium Gravel Multi Color</h3>

            <p class="price">₪15</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 3 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Artificial Green Plant.png">
            </div>

            <h3>Artificial Green Plant</h3>

            <p class="price">₪5</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 4 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Artificial Green Aquarium Plant.jpeg">
            </div>

            <h3>Artificial Green Aquarium Plant</h3>

            <p class="price">₪8</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 5 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Tall Artificial Aquarium Tree.png">
            </div>

            <h3>Tall Artificial Aquarium Tree</h3>

            <p class="price">₪15</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 6 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Mini Aquarium Lavender Decoration.png">
            </div>

            <h3>Mini Aquarium Lavender Plant</h3>

            <p class="price">₪5</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 7 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Artificial Pink & Purple Aquarium Plant.jpeg">
            </div>

            <h3>Artificial Pink & Purple Aquarium Plant</h3>

            <p class="price">₪8</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 8 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Artificial Pink Aquarium Plant.png">
            </div>

            <h3>Artificial Pink Aquarium Plant</h3>

            <p class="price">₪10</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 9 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Pink Coral Aquarium Ornament.jpg">
            </div>

            <h3>Pink Coral Aquarium Ornament</h3>

            <p class="price">₪15</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 10 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Decorative Broken Vase Aquarium Ornament.png">
            </div>

            <h3>Decorative Broken Vase Aquarium Ornament</h3>

            <p class="price">₪30</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 11 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Natural Style Rock Aquarium Ornament.png">
            </div>

            <h3>Natural Style Rock Aquarium Ornament</h3>

            <p class="price">₪25</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 12 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Aquarium Rock Mountain Ornament.png">
            </div>

            <h3>Aquarium Rock Mountain Ornament</h3>

            <p class="price">₪30</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 13 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Mini Bridge Aquarium Ornament.jpeg">
            </div>

            <h3>Mini Bridge Aquarium Ornament</h3>

            <p class="price">₪30</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 14 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Mini Castle Aquarium Ornament.png">
            </div>

            <h3>Mini Castle Aquarium Ornament</h3>

            <p class="price">₪20</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 15 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Vintage Motorcycle Aquarium Decoration.jpeg">
            </div>

            <h3>Vintage Motorcycle Aquarium Decoration</h3>

            <p class="price">₪25</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <!-- PRODUCT 16 -->
        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Sunken Ship Aquarium Decoration.png">
            </div>

            <h3>Sunken Ship Aquarium Decoration</h3>

            <p class="price">₪40</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>
        <div class="product-card"> <div class="img-box">
                <img src="imgs/Green Frog Aquarium Ornament.jpg" alt="Green Frog Aquarium Ornament">
            </div>
            <h3>Green Frog Aquarium Ornament</h3>
            <p class="price">₪15</p>
            <div class="quantity"> <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div> <button>Add to Cart</button> </div>
        <div class="product-card"> <div class="img-box">
                <img src="imgs/Round Aquarium LED Light.jpeg" alt="Round Aquarium LED Light"> </div>
            <h3>Round Aquarium LED Light</h3>
            <p class="price">₪20</p>
            <div class="quantity"> <label>Quantity</label>
                <input type="number" value="1" min="1"> </div>
            <button>Add to Cart</button> </div>
        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Adjustable Arm Aquarium LED Light.jpg" alt="Adjustable Arm Aquarium LED Light">
            </div>
            <h3>Adjustable Arm Aquarium LED Light</h3>
            <p class="price">₪30</p> <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div> <button>Add to Cart</button> </div>
        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Underwater Aquarium LED Light Bar.jpg" alt="Underwater Aquarium LED Light Bar">
            </div>
            <h3>Underwater Aquarium LED Light Bar</h3>
            <p class="price">₪25</p>
            <div class="quantity"> <label>Quantity</label>
                <input type="number" value="1" min="1"> </div>
            <button>Add to Cart</button> </div>

    </div>

</section>
<a href="fish.php" class="back-btn">⬅ Back</a>

<script>
    document.querySelectorAll(".product-card").forEach(card => {
        const sizes = card.querySelectorAll(".size");
        const price = card.querySelector(".price");
        const img = card.querySelector("img");
        const name = card.querySelector(".product-name");
        sizes.forEach(btn => {
            btn.addEventListener("click", () => {
                sizes.forEach(b =>
                    b.classList.remove("active"));
                btn.classList.add("active");
                // PRICE
                if(price && btn.dataset.price){
                    price.textContent =
                        "₪" + btn.dataset.price;
                }
                // IMAGE
                if(img && btn.dataset.img){
                    img.src = btn.dataset.img;
                }
                // NAME
                if(name && btn.dataset.name){
                    name.textContent =
                        name.dataset.base +
                        " - " +
                        btn.dataset.name;
                }
            });
        });
    });
</script>

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
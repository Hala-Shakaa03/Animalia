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
    <title>Cat Bowls</title>
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

            font-size:60px;

            margin:60px 0;

            color:#4b3527;

            font-weight:800;
        }

        /* =========================
           SECTION
        ========================= */

        .section{

            width:92%;

            max-width:1500px;

            margin:0 auto 70px;
        }

        /* =========================
           PRODUCTS GRID
        ========================= */

        .products{

            display:grid;

            grid-template-columns:
    repeat(auto-fit,minmax(270px,1fr));

            gap:32px;
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

            min-height:540px;
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

            height:240px;

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

            min-height:72px;

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

            width:220px;

            display:flex;

            justify-content:center;

            align-items:center;

            margin:20px auto 80px;

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
                font-size:46px;
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

<h1 class="page-title">Cat Bowls</h1>

<section class="section">
    <h2>Food Bowls</h2>
    <div class="products">

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Pink%20Food%20Bowls.jpg" alt="Round Deep Plastic Pink Cat Food Bowl">
            </div>
            <h3>Round Deep Plastic Pink Cat Food Bowl</h3>
            <p class="price">₪5</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/orange%20bowl.png" alt="Round Deep Plastic Orange Cat Food Bowl">
            </div>
            <h3>Round Deep Plastic Orange Cat Food Bowl</h3>
            <p class="price">₪5</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Non-Slip%20Wide%20Base%20Plastic%20Pet%20Bowl.png" alt="Non-Slip Wide Base Blue Cat Bowl">
            </div>
            <h3>Non-Slip Wide Base Blue Cat Food Bowl</h3>
            <p class="price">₪5</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Rounded%20Square%20Plastic%20Pet%20Bowl.jpeg" alt="Rounded Square Plastic Cat Bowl">
            </div>
            <h3>Rounded Square Plastic Cat Bowl</h3>
            <p class="price">₪5</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Slow%20Feeder%20Cat%20Bowl.jpeg" alt="Slow Feeder Cat Bowl">
            </div>
            <h3>Slow Feeder Cat Bowl</h3>
            <p class="price">₪7</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Non-Slip%20Base%20Stainless%20Steel%20Cat%20Bowl.jpg" alt="Non-Slip Base Stainless Steel Cat Bowl">
            </div>
            <h3>Non-Slip Base Stainless Steel Cat Bowl</h3>
            <p class="price">₪8</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Double%20Cat%20Food%20&%20Water%20Bowl.png" alt="Double Cat Food & Water Bowl">
            </div>
            <h3>Double Plastic Cat Food & Water Bowl</h3>
            <p class="price">₪10</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Stainless%20Steel%20Double%20Cat%20Bowl.jpeg" alt="Stainless Steel Double Cat Bowl">
            </div>
            <h3>Stainless Steel Double Cat Bowl</h3>
            <p class="price">₪15</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Rectangular%20Gravity%20Cat%20Feeder.jpg" alt="Rectangular Gravity Cat Feeder">
            </div>
            <h3>Rectangular Gravity Cat Feeder</h3>
            <p class="price">₪20</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Automatic%20Gravity%20Pet%20Feeder%20Round.jpg" alt="Tower Maze With Balls and Feathers">
            </div>
            <h3>Rounded Gravity Cat Feeder</h3>
            <p class="price">₪18</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>


    </div>
</section>

<section class="section">
    <h2>Water Dispensers</h2>
    <div class="products">

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Round%20Gravity%20Water%20Dispenser.png" alt="Round Gravity Water Dispenser">
            </div>
            <h3>Round Gravity Water Dispenser</h3>
            <p class="price">₪18</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Square%20Gravity%20Water%20Dispenser.jpg" alt="Rectangle Gravity Water Dispenser">
            </div>
            <h3>Rectangle Gravity Water Dispenser</h3>
            <p class="price">₪20</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Automatic%20Water%20Dispenser%20with%20Food%20Bowl.jpg" alt="Automatic Water Dispenser with Food Bowl">
            </div>
            <h3>Automatic Water Dispenser with Food Bowl</h3>
            <p class="price">₪45</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Automatic%20Cat%20Water%20Fountain.jpg" alt="Automatic Cat Water Fountain">
            </div>
            <h3>Automatic Square Cat Water Fountain</h3>
            <p class="price">₪40</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Ceramic%20Round%20Cat%20Water%20Fountain.jpg" alt="Ceramic Round Cat Water Fountain">
            </div>
            <h3>Ceramic Round Cat Water Fountain</h3>
            <p class="price">₪50</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

    </div>
</section>


<a href="cat-supplies.php" class="back-btn">⬅ Back</a>

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

                            const cartNumber = document.querySelector(".cart-number");

                            if(cartNumber){

                                let currentNumber = parseInt(cartNumber.textContent || 0);

                                cartNumber.textContent = currentNumber + quantity;
                            }
                        }

                    });

            });

        });

</script>
</body>
</html>
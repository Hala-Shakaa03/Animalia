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
    <title>Fish Tank Filters</title>
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

            min-height:500px;
        }

        .product-card:hover{
            transform:translateY(-8px);
        }

        /* =========================
           IMAGE BOX
        ========================= */

        .img-box{

            width:100%;

            height:220px;

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

        @media(max-width:768px) {

            .page-title {
                font-size: 38px;
            }

            .products {
                grid-template-columns:1fr;
            }

            .img-box {
                height: 210px;
            }

            .product-card {
                min-height: auto;
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

<h1 class="page-title">Fish Tank Filters</h1>

<section class="section">
    <div class="products">

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Fish Tank Air Pump (2 Outlets).jpeg" alt="Fish Tank Air Pump (2 Outlets)">
            </div>
            <h3>Fish Tank Air Pump - 2 Outlets</h3>
            <p class="price">₪35</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Aquarium Submersible Water Pump.jpeg" alt="Aquarium Submersible Water Pump">
            </div>
            <h3>Aquarium Submersible Water Pump</h3>
            <p class="price">₪40</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Fish Tank Silicone Air Tubing (15m).jpg" alt="Fish Tank Silicone Air Tubing (15m)">
            </div>
            <h3>Fish Tank Silicone Air Tubing - 15m</h3>
            <p class="price">₪15</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Fish Tank Silicone Air Tubing (50m).png" alt="Fish Tank Silicone Air Tubing (50m)">
            </div>
            <h3>Fish Tank Silicone Air Tubing - 50m</h3>
            <p class="price">₪50</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Internal Aquarium Filter.jpg" alt="Internal Aquarium Filter">
            </div>
            <h3>Internal Aquarium Filter</h3>
            <p class="price">₪50</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Aquarium Filter Sponge.png" alt="Aquarium Filter Sponge">
            </div>
            <h3>Aquarium Filter Sponge</h3>
            <p class="price">₪15</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Aquarium Glass Cleaner Sponge.jpg" alt="Aquarium Glass Cleaner Sponge">
            </div>
            <h3>Aquarium Glass Cleaner Sponge</h3>
            <p class="price">₪10</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Cylindrical Air Stone.png" alt="Cylindrical Air Stone">
            </div>
            <h3>Cylindrical Air Stone</h3>
            <p class="price">₪5</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Aquarium Air Stone (Dome Shape).jpg" alt="Aquarium Air Stone Dome Shape">
            </div>
            <h3>Dome Shaped Aquarium Air Stone </h3>
            <p class="price">₪10</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Shell-Shaped Air Stone.jpeg" alt="Shell-Shaped Air Stone">
            </div>
            <h3>Shell Shaped Air Stone </h3>
            <p class="price">₪8</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Turtle-Shaped Air Stone.jpeg" alt="Turtle-Shaped Air Stone">
            </div>
            <h3>Turtle Shaped Air Stone</h3>
            <p class="price">₪8</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

    </div>
</section>

<a href="fish.php" class="back-btn">⬅ Back</a>

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
</body>
</html>
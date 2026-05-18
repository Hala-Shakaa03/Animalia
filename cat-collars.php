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
    <title>Collars and Clothes</title>
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

            font-size:64px;

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

            margin:0 auto 90px;
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

            background:white;

            border-radius:35px;

            padding:22px;

            text-align:center;

            overflow:hidden;

            box-shadow:
                    0 10px 30px rgba(0,0,0,.06);

            transition:.4s;

            display:flex;

            flex-direction:column;

            justify-content:space-between;

            min-height:620px;
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

            height:260px;

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
                    scale(1.08)
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

            min-height:85px;

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
           SIZES
        ========================= */

        .sizes{

            display:flex;

            justify-content:center;

            gap:10px;

            flex-wrap:wrap;

            margin-bottom:20px;
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

            .products{
                grid-template-columns:
        repeat(auto-fit,minmax(240px,1fr));
            }
        }

        @media(max-width:768px){

            .page-title{
                font-size:40px;
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
<h1 class="page-title">Collars & Clothes</h1>

<section class="section">


    <div class="products">

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/cat%20walking%20collar.jpeg" alt="Cat Harness with Leash">
            </div>

            <h3>Cat Harness with Leash </h3>
            <p class="price">₪10</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>


        <div class="product-card">

            <div class="img-box">
                <img src="imgs/cat%20vest%20with%20attacheable%20collar.jpeg" alt="Vest Cat Harness with Leash">
            </div>

            <h3>Pink Vest Cat Harness with Leash </h3>
            <p class="price">₪20</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/cat%20vest%20with%20removable%20collar.jpeg" alt="Vest Cat Harness with Leash">
            </div>

            <h3>Baby Blue & Gray Vest Cat Harness with Leash</h3>
            <p class="price">₪20</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/cat%20vest.jpeg" alt="Crochet Cat Vest">
            </div>

            <h3 class="product-name" data-base="Crochet Cat Vest">
                Crochet Cat Vest - S
            </h3>

            <p class="price">₪15</p>

            <div class="sizes">
                <span class="size active" data-name="S">S</span>
                <span class="size" data-name="M">M</span>
                <span class="size" data-name="L">L</span>
                <span class="size" data-name="XL">XL</span>
            </div>

            <div class="quantity">
                <label>Quantity:</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/collars.jfif" alt="Cat Collar">
            </div>
            <h3 class="product-name" data-base="Adjustable Cat Collar">Adjustable Cat Collar - Red</h3>
            <p class="price">₪5</p>
            <div class="sizes">
                <span class="size active" data-name="Red">Red</span>
                <span class="size" data-name="Purple">Purple</span>
                <span class="size" data-name="Blue">Blue</span>
                <span class="size" data-name="Green">Green</span>
            </div>
            <div class="quantity">
                <label>Quantity:</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/lavender%20collar.jfif" alt="Adjustable Lavender cat collar">
            </div>
            <h3>Adjustable Cat Collar - Lavender</h3>
            <p class="price">₪5</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/pink%20collar.jfif" alt="Adjustable Pink Cat Collar">
            </div>
            <h3>Adjustable Sparkly Cat Collar - Pink</h3>
            <p class="price">₪7</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/glow%20in%20the%20dark%20pink%20collar.jfif" alt="Adjustable glowy Pink Cat Collar">
            </div>
            <h3>Adjustable Glow In The Dark Cat Collar - Pink</h3>
            <p class="price">₪5</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/gold%20moon%20navy%20collar.jfif" alt="Moon & Stars Adjustable Cat Collar">
            </div>
            <h3>Adjustable Moon & Stars Cat Collar - Navy Blue</h3>
            <p class="price">₪5</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/velvet%20green%20collar.jfif" alt="Velvet Green Cat Collar with Bow">
            </div>
            <h3>Adjustable Velvet Cat Collar with Bow – Green</h3>
            <p class="price">₪7</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/pearls%20collar.png" alt="Pearl Cat Collar with Heart Charm">
            </div>
            <h3>Pearl Cat Collar with Heart Charm</h3>
            <p class="price">₪8</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>
    </div>
</section>


<a href="cat-supplies.php" class="back-btn">⬅ Back</a>
<!--<script>-->

<!--    document.querySelectorAll(".product-card").forEach(card => {-->
<!--        const options = card.querySelectorAll(".size");-->
<!--        const name = card.querySelector(".product-name");-->

<!--        options.forEach(btn => {-->
<!--            btn.addEventListener("click", () => {-->
<!--                options.forEach(b => b.classList.remove("active"));-->
<!--                btn.classList.add("active");-->

<!--                if (name && btn.dataset.name) {-->
<!--                    name.textContent = name.dataset.base + " - " + btn.dataset.name;-->
<!--                }-->
<!--            });-->
<!--        });-->
<!--    });-->
<!--</script>-->

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
       SIZE BUTTONS
    ========================= */

    document.querySelectorAll(".product-card").forEach(card => {

        const options =
            card.querySelectorAll(".size");

        const name =
            card.querySelector(".product-name");

        options.forEach(btn => {

            btn.addEventListener("click", () => {

                options.forEach(b =>
                    b.classList.remove("active")
                );

                btn.classList.add("active");

                if(name){

                    name.textContent =
                        name.dataset.base +
                        " - " +
                        btn.innerText;
                }
            });
        });
    });


    /* =========================
       ADD TO CART - BACKEND
    ========================= */

    document.querySelectorAll(".product-card button")
        .forEach(function(button){

            button.setAttribute("type", "button");

            button.addEventListener("click", function(){

                const card =
                    button.closest(".product-card");

                const name =
                    card.querySelector("h3").innerText;

                const priceText =
                    card.querySelector(".price").innerText;

                const price =
                    parseFloat(
                        priceText.replace("₪","")
                    );

                const image =
                    card.querySelector("img")
                        .getAttribute("src");

                const quantity =
                    parseInt(
                        card.querySelector(".quantity input").value
                    );

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
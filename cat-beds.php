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
    <title>Cat Beds</title>

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
            color:#3e2f26;
            overflow-x:hidden;
        }

        header{
            background:white;
            padding:20px 7%;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 4px 15px rgba(0,0,0,.05);
            position:sticky;
            top:0;
            z-index:999;
        }

        .logo{
            font-size:38px;
            font-weight:800;
            color:#4b3527;
        }

        nav ul{
            display:flex;
            gap:30px;
            list-style:none;
        }

        nav ul li{
            position:relative;
        }

        nav ul li a{
            text-decoration:none;
            color:#4b3527;
            font-weight:600;
            transition:.3s;
        }

        nav ul li a:hover{
            color:#8b5e3c;
        }

        .dropdown-menu{
            position:absolute;
            top:40px;
            left:0;
            background:white;
            min-width:220px;
            border-radius:18px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
            padding:12px 0;
            display:none;
            z-index:1000;
        }

        .dropdown-menu li{
            width:100%;
        }

        .dropdown-menu li a{
            display:block;
            padding:12px 18px;
        }

        .dropdown:hover .dropdown-menu{
            display:block;
        }

        .login-btn{
            background:#8b5e3c;
            color:white;
            padding:10px 20px;
            border-radius:999px;
        }

        .login-btn:hover{
            background:#4b3527;
            color:white;
        }

        .page-title{
            text-align:center;
            font-size:60px;
            margin:60px 0 20px;
            color:#3e2414;
            font-weight:800;
        }

        .section{
            width:90%;
            max-width:1550px;
            margin:auto;
            padding-bottom:70px;
        }

        .section h2{
            font-size:38px;
            margin-bottom:35px;
            color:#4b3527;
        }

        .products{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:32px;
        }

        .product-card{
            background:white;
            border-radius:32px;
            padding:22px;
            text-align:center;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
            transition:.4s;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            min-height:620px;
        }

        .product-card:hover{
            transform:translateY(-10px);
            box-shadow:0 18px 35px rgba(0,0,0,.08);
        }

        .img-box{
            height:250px;
            border-radius:28px;
            background:linear-gradient(135deg,#f3e2d1,#faf6f1);
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

        .product-card h3{
            font-size:22px;
            line-height:1.5;
            margin-bottom:12px;
            color:#4b3527;
            min-height:70px;
        }

        .price{
            font-size:32px;
            font-weight:800;
            color:#8b5e3c;
            margin-bottom:18px;
        }

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
            cursor:pointer;
            transition:.3s;
            font-size:14px;
            font-weight:600;
            color:#4b3527;
        }

        .size:hover,
        .size.active{
            background:#8b5e3c;
            color:white;
        }

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

        .product-card button{
            width:100%;
            border:none;
            background:linear-gradient(to right,#4b3527,#8b5e3c);
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

        .back-btn{
            width:230px;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:20px auto 90px;
            text-decoration:none;
            background:linear-gradient(to right,#4b3527,#8b5e3c);
            color:white;
            padding:17px;
            border-radius:999px;
            font-size:18px;
            font-weight:700;
            transition:.35s;
        }

        .back-btn:hover{
            transform:translateY(-4px);
            box-shadow:0 10px 25px rgba(139,94,60,.25);
        }

        @media(max-width:992px){
            .page-title{
                font-size:48px;
            }

            .section h2{
                font-size:30px;
            }

            .products{
                grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            }

            header{
                flex-direction:column;
                gap:20px;
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

            nav ul{
                flex-wrap:wrap;
                justify-content:center;
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
        Free delivery on orders over ₪100
    </div>

    <div class="topbar-right">
        <a href="https://facebook.com"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://instagram.com"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://twitter.com"><i class="fa-brands fa-twitter"></i></a>
    </div>
</div>
<header class="header">
    <div class="container header-content">
        <div class="logo">
            <img src="imgs/logo.png" alt="Animalia Logo">
        </div>
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
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search products...">
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
<h1 class="page-title">Cat Beds</h1>
<section class="section" id="cat-beds">
    <h2>Cat Beds & Trees</h2>
    <div class="products">

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Small%20Soft%20Yellow%20&%20Brown%20Polka%20Dots%20Cat%20Bed.jpeg"
                     alt="Soft Yellow & Brown Polka Dots Cat Bed">
            </div>

            <h3>Soft Yellow & Brown Polka Dots Cat Bed</h3>

            <p class="price">₪10</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Round%20Fluffy%20Pink%20Cat%20Bed.png" id="bed-img">
            </div>

            <h3 class="product-name" data-base="Round Fluffy Cat Bed">
                Round Fluffy Cat Bed - 60cm
            </h3>

            <p class="price">₪40</p>

            <div class="sizes">
                <span class="size active" data-price="40" data-name="60cm">60cm</span>
                <span class="size" data-price="50" data-name="70cm">70cm</span>
                <span class="size" data-price="60" data-name="80cm">80cm</span>
            </div>

            <div class="quantity">
                <label>Quantity:</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>

        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Bunny%20Ears%20Cave%20Bed.jfif" alt="Bunny Ears Cave Bed">
            </div>

            <h3>Bunny Ears Cave Bed</h3>

            <p class="price">₪35</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Banana%20Cat%20Bed.jpeg" alt="Banana Cat Bed">
            </div>

            <h3>Banana Cat Bed</h3>

            <p class="price">₪25</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Cat%20Tree%20with%20Scratching%20Post.jpeg" alt="Cat Tree with Scratching Post">
            </div>

            <h3>Cat Tree with Scratching Post</h3>

            <p class="price">₪100</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Multi-Level%20Cat%20Tree.png" alt="Multi-Level Cat Tree">
            </div>

            <h3>Multi-Level Cat Tree</h3>

            <p class="price">₪120</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Multi-Level%20Cat%20Activity%20Tree.jfif" alt="Multi-Level Cat Activity Tree">
            </div>

            <h3>Multi-Level Cat Activity Tree</h3>

            <p class="price">₪150</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

    </div>
</section>

<section class="section" id="cat-carriers">
    <h2>Cat Carriers & Travel Bags</h2>

    <div class="products">

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Transparent%20Bubble%20Cat%20Backpack%20-%20Pink.png">
            </div>

            <h3 class="product-name" data-base="Transparent Bubble Cat Backpack">
                Transparent Bubble Cat Backpack - Pink
            </h3>

            <p class="price">₪40</p>

            <div class="sizes">
                <span class="size active"
                      data-name="Pink"
                      data-img="imgs/Transparent%20Bubble%20Cat%20Backpack%20-%20Pink.png">Pink</span>

                <span class="size"
                      data-name="Gray"
                      data-img="imgs/Transparent%20Bubble%20Cat%20Backpack%20-%20Gray.png">Gray</span>

                <span class="size"
                      data-name="Black"
                      data-img="imgs/Transparent%20Bubble%20Cat%20Backpack%20-%20Black.png">Black</span>

                <span class="size"
                      data-name="Green"
                      data-img="imgs/Transparent%20Bubble%20Cat%20Backpack%20-%20Green.png">Green</span>
            </div>

            <div class="quantity">
                <label>Quantity:</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Soft%20Cat%20Carrier%20Backpack.jpg" alt="Soft Cat Carrier Backpack">
            </div>

            <h3>Soft Cat Carrier Backpack</h3>

            <p class="price">₪40</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Cat%20Face%20Carrier%20Backpack%20–%2034×25×33%20cm.jpg"
                     alt="Cat Face Carrier Backpack">
            </div>

            <h3>Cat Face Carrier Backpack</h3>

            <p class="price">₪35</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Cute Portable Cat Carrier Bag.jpg" alt="Cute Portable Cat Carrier Bag">
            </div>

            <h3>Cute Portable Cat Carrier Bag</h3>

            <p class="price">₪35</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Soft Cat Carrier Shoulder Bag.jpg" alt="Soft Cat Carrier Shoulder Bag">
            </div>

            <h3>Soft Cat Carrier Shoulder Bag</h3>

            <p class="price">₪50</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Blue Transparent Cat Carrier Bag.jpeg" alt="Blue Transparent Cat Carrier Bag">
            </div>

            <h3>Blue Transparent Cat Carrier Bag</h3>

            <p class="price">₪55</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Yellow Foldable Cat Carrier Box.jpeg" alt="Yellow Foldable Cat Carrier Box">
            </div>

            <h3>Yellow Foldable Cat Carrier Box</h3>

            <p class="price">₪75</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Blue Hard-Sided Cat Carrier.jpg" alt="Blue Hard-Sided Cat Carrier">
            </div>

            <h3>Blue Hard-Sided Cat Carrier</h3>

            <p class="price">₪35</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>

            <button type="button">Add to Cart</button>
        </div>

    </div>
</section>
<a href="cat-supplies.php" class="back-btn">⬅ Back</a>
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
            <!--            <a href="contact.php">Refund & Returns</a>-->
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
       SIZE / COLOR BUTTONS
    ========================= */
    document.querySelectorAll(".product-card").forEach(card => {
        const sizes = card.querySelectorAll(".size");
        const price = card.querySelector(".price");
        const img = card.querySelector("img");
        const name = card.querySelector(".product-name");
        sizes.forEach(btn => {
            btn.addEventListener("click", () => {
                sizes.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                if(btn.dataset.price){
                    price.textContent = "₪" + btn.dataset.price;
                }
                if(btn.dataset.img){
                    img.src = btn.dataset.img;
                }
                if(name && btn.dataset.name){
                    name.textContent = name.dataset.base + " - " + btn.dataset.name;
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
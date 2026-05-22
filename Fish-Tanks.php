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
    <title>Fish Tanks</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<STYLE>
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
        font-weight:800;
        color:#4b3527;
    }

    /* =========================
       SECTION
    ========================= */

    .section{
        width:92%;
        max-width:1500px;
        margin:auto;
    }

    /* =========================
       PRODUCTS GRID
    ========================= */

    .products{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:30px;
        margin-bottom:80px;
    }

    /* =========================
       PRODUCT CARD
    ========================= */

    .product-card{
        background:white;
        border-radius:35px;
        padding:22px;
        text-align:center;
        box-shadow:0 10px 30px rgba(0,0,0,.06);
        transition:.4s;
    }

    .product-card:hover{
        transform:translateY(-10px);
    }

    /* =========================
       IMAGE
    ========================= */

    .img-box{
        height:250px;
        border-radius:28px;
        background:linear-gradient(135deg,#f3e2d1,#faf7f3);
        display:flex;
        align-items:center;
        justify-content:center;
        overflow:hidden;
        margin-bottom:20px;
    }

    .img-box img{
        width:320px;
        height:320px;
        object-fit:contain;
        transition:.4s;
    }

    .product-card:hover img{
        transform:scale(1.08);
    }

    /* =========================
       NAME
    ========================= */

    .product-card h3{
        font-size:23px;
        line-height:1.4;
        margin-bottom:12px;
        min-height:65px;
    }

    /* =========================
       PRICE
    ========================= */

    .price{
        font-size:30px;
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
        flex-wrap:wrap;
        margin-bottom:20px;
    }

    .size{
        padding:10px 15px;
        border-radius:999px;
        background:#f3e2d1;
        cursor:pointer;
        transition:.3s;
        font-size:14px;
        font-weight:600;
    }

    .size:hover{
        background:#8b5e3c;
        color:white;
    }

    .size.active{
        background:#4b3527;
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
        font-size:16px;
    }

    /* =========================
       BUTTON
    ========================= */

    .product-card button{
        width:100%;
        border:none;
        padding:15px;
        border-radius:999px;
        background:linear-gradient(to right,#4b3527,#8b5e3c);
        color:white;
        font-size:16px;
        font-weight:700;
        cursor:pointer;
        transition:.3s;
    }

    .product-card button:hover{
        transform:translateY(-4px);
    }

    /* =========================
       BACK BUTTON
    ========================= */

    .back-btn{
        width:220px;
        margin:40px auto 90px;
        display:flex;
        justify-content:center;
        align-items:center;
        text-decoration:none;
        background:#4b3527;
        color:white;
        padding:18px;
        border-radius:999px;
        font-size:18px;
        font-weight:600;
        transition:.3s;
    }

    .back-btn:hover{
        background:#8b5e3c;
        transform:translateY(-5px);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width:1200px){

        .products{
            grid-template-columns:repeat(3,1fr);
        }
    }

    @media(max-width:900px){

        .products{
            grid-template-columns:repeat(2,1fr);
        }
    }

    @media(max-width:650px){

        .products{
            grid-template-columns:1fr;
        }

        .page-title{
            font-size:38px;
        }
    }.quantity input{
         width:90px;
         height:45px;

         direction:ltr !important;
         unicode-bidi:plaintext;

         text-align:center;

         border:none;
         outline:none;

         border-radius:14px;
         background:#f7efe7;

         font-size:18px;
         font-weight:600;
         color:#4b3527;
     }
</STYLE>
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

<h1 class="page-title">Fish Tanks & Bowls</h1>

<section class="section" id="fish-tanks">
    <div class="products">

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Glass Fish Tank – 10 Gallon (38L).jfif" alt="Glass Fish Tank – 10 Gallon (38L)">
            </div>
            <h3>Glass Fish Tank – 10 Gallon (38L)</h3>
            <p class="price">₪100</p>

            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Coverd Glass Fish Tank – 10 Gallon (38L).jfif" alt="Coverd Glass Fish Tank – 10 Gallon (38L)">
            </div>
            <h3>Covered Glass Fish Tank – 10 Gallon (38L)</h3>
            <p class="price">₪120</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Blue Rectangle Plastic Fish Tank.jfif">
            </div>
            <h3 class="product-name" data-base="Blue Rectangle Plastic Fish Tank">
                Rectangle Plastic Fish Tank - Blue
            </h3>
            <p class="price">₪5</p>
            <div class="sizes">
        <span class="size active"
              data-name="Blue"
              data-img="imgs/Blue Rectangle Plastic Fish Tank.jfif">Blue</span>
                <span class="size"
                      data-name="Pink"
                      data-img="imgs/Pink Rectangle Plastik Fish Tank.png">Pink</span>
                <span class="size"
                      data-name="Red"
                      data-img="imgs/Red Rectangle Plastik Fish Tank.png">Red</span>
                <span class="size"
                      data-name="Yellow"
                      data-img="imgs/Yellow Rectangle Plastik Fish Tank.png">Yellow</span>
            </div>
            <div class="quantity">
                <label>Quantity:</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Standard Fish Bowl - 200ML.jfif" alt="Standard Fish Bowl - 200ML">
            </div>
            <h3>Standard Fish Bowl - 200ML</h3>
            <p class="price">₪20</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Two Fish Bowls With Small Legs - 200mL, 80mL.jfif" alt="Two Fish Bowls With Small Legs - 200mL, 80mL">
            </div>
            <h3>Two Fish Bowls With Small Legs - 200mL, 80mL</h3>
            <p class="price">₪25</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Fish Bowl With Wooden Base.jfif" alt="Fish Bowl With Wooden Base">
            </div>
            <h3>Fish Bowl With Wooden Base</h3>
            <p class="price">₪25</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Small Fish Bowl With Stand.jfif" alt="Small Fish Bowl With Stand">
            </div>
            <h3>Small Fish Bowl With Stand</h3>
            <p class="price">₪20</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Fish Bowl With Decorative Stand.jpg" alt="Fish Bowl With Decorative Stand">
            </div>
            <h3>Fish Bowl With Decorative Stand.jpg</h3>
            <p class="price">₪30</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>


        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Hanging Fish Bowl With Black Stand.jfif">
            </div>
            <h3 class="product-name" data-base="Hanging Fish Bowl With Stand">
                Hanging Fish Bowl With Stand - Black
            </h3>
            <p class="price">₪25</p>
            <div class="sizes">
        <span class="size active"
              data-name="Black"
              data-img="imgs/Hanging Fish Bowl With Black Stand.jfif">Black</span>
                <span class="size"
                      data-name="White"
                      data-img="imgs/Hanging Fish Bowl With White Stand .jfif">White</span>

            </div>
            <div class="quantity">
                <label>Quantity:</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">
            <div class="img-box">
                <img src="imgs/Wall Hanging Fish Bowl.jfif" alt="Wall Hanging Fish Bowl">
            </div>
            <h3>Wall Hanging Fish Bowl</h3>
            <p class="price">₪35</p>
            <div class="quantity">
                <label>Quantity</label>
                <input type="number" value="1" min="1">
            </div>
            <button>Add to Cart</button>
        </div>

        <div class="product-card">

            <div class="img-box">
                <img src="imgs/Fish Net - Black.jpg">
            </div>

            <h3 class="product-name" data-base="Black Fish Net">
                Black Fish Net - 10cm
            </h3>

            <p class="price">₪5</p>

            <div class="sizes">
        <span class="size active"
              data-name="10cm"
              data-price="5"
              data-img="imgs/Fish Net - Black.jpg">10cm</span>

                <span class="size"
                      data-name="15cm"
                      data-price="7"
                      data-img="imgs/Fish Net - Black.jpg">15cm</span>

                <span class="size"
                      data-name="20cm"
                      data-price="9"
                      data-img="imgs/Fish Net - Black.jpg">20cm</span>
            </div>

            <div class="quantity">
                <label>Quantity:</label>
                <input type="number" value="1" min="1">
            </div>

            <button>Add to Cart</button>

        </div>


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

                sizes.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");

                // السعر
                if (price && btn.dataset.price) {
                    price.textContent = "₪" + btn.dataset.price;
                }
                // الصورة
                if (img && btn.dataset.img) {
                    img.src = btn.dataset.img;
                }
                // الاسم + الطول
                if (name && btn.dataset.name) {
                    name.textContent = name.dataset.base + " - " + btn.dataset.name;
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
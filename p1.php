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
    <title>Animalia Pet Store</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet"
          href="all.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
</head>

<body>

<!-- =========================
     TOPBAR
========================= -->

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
     HERO
========================= -->

<section class="hero">

    <div class="container hero-content">

        <!-- HERO TEXT -->

        <div class="hero-text">


            <h1>
                Make Your Pets
                Happy Every Day
            </h1>

            <p>
                Discover premium food, toys, accessories and grooming
                products for your lovely pets with the best quality and prices.
            </p>

            <div class="hero-buttons">

                <a href="about.html" class="main-btn">
                    About Us

                    <i class="fa-solid fa-cart-shopping"></i>

                </a>



            </div>

            <!-- STATS -->

            <div class="hero-stats">

                <div class="stat-box">

                    <i class="fa-solid fa-paw"></i>

                    <div>
                        <h3>1K+</h3>
                        <span>Happy Clients</span>
                    </div>

                </div>

                <div class="stat-box">

                    <i class="fa-solid fa-box"></i>

                    <div>
                        <h3>300+</h3>
                        <span>Pet Products</span>
                    </div>

                </div>

                <div class="stat-box">

                    <i class="fa-solid fa-headset"></i>

                    <div>
                        <h3>24/7</h3>
                        <span>Support</span>
                    </div>

                </div>

            </div>

        </div>

        <!-- HERO IMAGE -->

        <div class="hero-image">


            <img src="imgs/petsss.png" alt="Pets">

        </div>

    </div>

</section>

<!-- =========================
     CATEGORIES
========================= -->
<section class="categories" id="categories">

    <div class="container">
        <h2>
            Shop Now

        </h2>
        <div class="pets-cards">

            <!-- CAT -->

            <a href="cat.php" class="pet-item">

                <div class="pet-image">

                    <img src="imgs/cato.png"
                         class="cat-img"
                         alt="Cat">

                </div>

                <div class="pet-info">

                    <h3>Cat Supplies</h3>

                    <span>Food • Toys • Care</span>

                </div>

            </a>

            <!-- DOG -->

            <a href="dog.php" class="pet-item">

                <div class="pet-image">

                    <img src="imgs/gf.png"
                         class="dog-img"
                         alt="Dog">

                </div>

                <div class="pet-info">

                    <h3>Dog Supplies</h3>

                    <span>Food • Toys • Care</span>

                </div>

            </a>

            <!-- BIRD -->

            <a href="bird.php" class="pet-item">

                <div class="pet-image">

                    <img src="imgs/bird.png"
                         class="bird-img"
                         alt="Bird">

                </div>

                <div class="pet-info">

                    <h3>Bird Supplies</h3>

                    <span>Cages • Food • Perches</span>

                </div>

            </a>

            <!-- FISH -->

            <a href="fish.php" class="pet-item">

                <div class="pet-image">

                    <img src="imgs/fish.png"
                         class="fish-img"
                         alt="Fish">

                </div>

                <div class="pet-info">

                    <h3>Aquarium</h3>

                    <span>Food • Tanks • Decor</span>

                </div>

            </a>

        </div>

    </div>

</section>

<section class="features">

    <div class="container features-grid">

        <div class="feature-box">

            <i class="fa-solid fa-truck"></i>

            <div>

                <h3>Free Delivery</h3>

                <p>On orders over ₪100</p>

            </div>

        </div>

        <div class="feature-box">

            <i class="fa-solid fa-shield"></i>

            <div>

                <h3>Secure Payment</h3>

                <p>100% protected</p>

            </div>

        </div>

        <div class="feature-box">

            <i class="fa-solid fa-award"></i>

            <div>

                <h3>Quality Products</h3>

                <p>Best quality for pets</p>

            </div>

        </div>

        <div class="feature-box">

            <i class="fa-solid fa-headset"></i>

            <div>

                <h3>24/7 Support</h3>

                <p>We are here to help</p>

            </div>

        </div>

    </div>

</section>
<!-- =========================
     FOOTER
========================= -->

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
<<script>

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
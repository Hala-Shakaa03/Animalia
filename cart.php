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


if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM cart_items WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);

$countSql = "SELECT SUM(quantity) AS total FROM cart_items WHERE user_id='$user_id'";
$countResult = mysqli_query($conn, $countSql);
$countRow = mysqli_fetch_assoc($countResult);
$totalItems = $countRow["total"] ?? 0;

$subtotal = 0;
$discount = 0;
$promoMessage = "";
$promoCode = "";

if(isset($_POST["promo"])){
    $promoCode = strtolower(trim($_POST["promo"]));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart</title>

    <link rel="stylesheet" href="all.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style3.css">
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
                <li><a href="p1.php">Home</a></li>
                <li><a href="p1.php#categories">Shop</a></li>

                <li class="dropdown">
                    <a href="p1.php#categories">
                        Store
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="cat.php">Cats</a></li>
                        <li><a href="dog.php">Dogs</a></li>
                        <li><a href="bird.php">Birds</a></li>
                        <li><a href="fish.php">Aquarium</a></li>
                    </ul>
                </li>

                <li><a href="about.html">About</a></li>

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

            <a href="profile.php" class="icon-btn">
                <i class="fa-solid fa-user"></i>
            </a>

            <a href="cart.php" class="icon-btn cart-btn">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-number"><?php echo $totalItems; ?></span>
            </a>

        </div>

    </div>

</header>

<section class="cart-section">

    <div class="cart-hero">

        <div class="cart-hero-text">
            <h1>Your Cart</h1>
            <p>Review your items and proceed to checkout</p>
        </div>

        <div class="cart-hero-image">
            <img src="imgs/chart.png" alt="Cart">
        </div>

    </div>

    <div class="cart-container">

        <div class="cart-items">

            <h2>Cart Items (<?php echo $totalItems; ?>)</h2>

            <?php if(isset($_GET["order"]) && $_GET["order"] == "success") { ?>
                <div class="success-message">
                    Order placed successfully!
                </div>
            <?php } ?>

            <?php if (mysqli_num_rows($result) == 0) { ?>

                <div class="empty-cart">
                    <h3>Your cart is empty</h3>
                    <p>Add some products to see them here.</p>
                    <a href="cat-food.php" class="checkout-btn">Continue Shopping</a>
                </div>

            <?php } else { ?>

                <?php while ($item = mysqli_fetch_assoc($result)) {
                    $itemTotal = $item["product_price"] * $item["quantity"];
                    $subtotal += $itemTotal;
                    ?>

                    <div class="cart-item">

                        <img src="<?php echo $item['product_image']; ?>" alt="">

                        <div class="item-info">
                            <h3><?php echo $item['product_name']; ?></h3>
                            <p>Price: ₪<?php echo $item['product_price']; ?></p>
                        </div>

                        <div class="cart-actions">

                            <div class="item-price">
                                ₪<?php echo $itemTotal; ?>
                            </div>

                            <div class="quantity-box">
                                <button onclick="updateCart(<?php echo $item['id']; ?>, 'minus')">-</button>
                                <span><?php echo $item['quantity']; ?></span>
                                <button onclick="updateCart(<?php echo $item['id']; ?>, 'plus')">+</button>
                            </div>

                            <button class="remove-btn" onclick="removeItem(<?php echo $item['id']; ?>)">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </div>

                    </div>

                <?php } ?>

            <?php } ?>

        </div>

        <?php

        if($promoCode != ""){

            if($promoCode == "animalia10"){

                $discount = $subtotal * 0.10;
                $promoMessage = "10% discount applied!";

            } else if($promoCode == "hala20"){

                $discount = $subtotal * 0.20;
                $promoMessage = "20% discount applied!";

            } else {

                $discount = 0;
                $promoMessage = "Invalid promo code!";
            }
        }

        $shipping = ($subtotal >= 100 || $subtotal == 0) ? 0 : 10;

        $total = ($subtotal - $discount) + $shipping;

        ?>

        <div class="order-summary">

            <h2>Order Summary</h2>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>₪<?php echo $subtotal; ?></span>
            </div>

            <div class="summary-row">
                <span>Discount</span>
                <span>-₪<?php echo $discount; ?></span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>₪<?php echo $shipping; ?></span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>₪<?php echo $total; ?></span>
            </div>

            <div class="payment-methods">

                <h2>Select Payment Method</h2>

                <label>
                    <input type="radio" name="payment" checked>
                    Cash on Delivery
                </label>

                <label>
                    <input type="radio" name="payment">
                    Credit Card
                </label>

            </div>

            <?php if ($subtotal > 0) { ?>
                <a href="checkout.php" class="checkout-btn">
                    Proceed to Checkout
                </a>
            <?php } ?>

            <div class="why-shop">

                <h2>
                    <i class="fa-solid fa-paw"></i>
                    Why Shop With Us?
                </h2>

                <div class="why-item">
                    <div class="why-icon">
                        <i class="fa-solid fa-truck"></i>
                    </div>
                    <div>
                        <h3>Free Delivery</h3>
                        <p>On orders over ₪100</p>
                    </div>
                </div>

                <div class="why-item">
                    <div class="why-icon">
                        <i class="fa-solid fa-rotate-left"></i>
                    </div>
                    <div>
                        <h3>Easy Returns</h3>
                        <p>Within 14 days</p>
                    </div>
                </div>

                <div class="why-item">
                    <div class="why-icon">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                    <div>
                        <h3>Secure Payment</h3>
                        <p>100% safe checkout</p>
                    </div>
                </div>

                <div class="why-item">
                    <div class="why-icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h3>24/7 Support</h3>
                        <p>We're here to help</p>
                    </div>
                </div>

            </div>

            <div class="promo-box">

                <h2>Have a promo code?</h2>

                <p>Enter your code to get discount</p>

                <form method="POST" class="promo-input">
                    <input type="text" name="promo" placeholder="Enter code">
                    <button type="submit">Apply</button>
                </form>

                <p style="margin-top:10px; font-weight:600; color:#8b5e3c;">
                    <?php echo $promoMessage; ?>
                </p>

            </div>

        </div>

    </div>

</section>

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

    function updateCart(id, action){

        fetch(`update_cart.php?id=${id}&action=${action}`)
            .then(() => {
                location.reload();
            });

    }

    function removeItem(id){

        fetch(`remove_cart.php?id=${id}`)
            .then(() => {
                location.reload();
            });

    }

</script>

<script>

    const searchInput =
        document.querySelector(".search-box input");

    searchInput.addEventListener("keypress", function(e){

        if(e.key === "Enter"){

            const value =
                searchInput.value.toLowerCase();

            if(value.includes("cat food") || value.includes("cat dry food") || value.includes("dry food")){
                window.location.href = "cat-food.php#dry-food";
            }

            else if(value.includes("cat wet food")){
                window.location.href = "cat-food.php#wet-food";
            }

            else if(value.includes("cat treat") || value.includes("cat treats")){
                window.location.href = "cat-food.php#cat-treats";
            }

            else if(value.includes("cat toy") || value.includes("cat toys")){
                window.location.href = "cat-toys.php";
            }

            else if(value.includes("cat collar") || value.includes("cat collars")){
                window.location.href = "cat-collars.php";
            }

            else if(
                value.includes("carrier") ||
                value.includes("travel bag") ||
                value.includes("cat bag") ||
                value.includes("cat carrier")
            ){
                window.location.href = "cat-beds.php#cat-carriers";
            }

            else if(value.includes("cat tree") || value.includes("cat bed") || value.includes("cat beds")){
                window.location.href = "cat-beds.php#cat-beds";
            }

            else if(value.includes("cat litter")){
                window.location.href = "cat-litter.php";
            }

            else if(value.includes("litter box") || value.includes("cat litter box")){
                window.location.href = "cat-litter.php#products";
            }

            else if(
                value.includes("food bowl") ||
                value.includes("food bowls") ||
                value.includes("cat bowl") ||
                value.includes("cat bowls")
            ){
                window.location.href = "cat-bowls.php#food-bowls";
            }

            else if(
                value.includes("water dispenser") ||
                value.includes("water dispensers") ||
                value.includes("water bowl") ||
                value.includes("water bowls")
            ){
                window.location.href = "cat-bowls.php#water-dispensers";
            }

            else if(value.includes("cat clothes")){
                window.location.href = "cat-collars.php";
            }

            else if(value.includes("cat")){
                window.location.href = "cat.php";
            }

            else if(value.includes("dog food") || value.includes("dog dry food")){
                window.location.href = "dog-food.php#dog-dry-food";
            }

            else if(value.includes("dog wet food")){
                window.location.href = "dog-food.php#dog-wet-food";
            }

            else if(value.includes("dog treats") || value.includes("treats")){
                window.location.href = "dog-food.php#dog-treats";
            }

            else if(value.includes("dog toy") || value.includes("dog toys")){
                window.location.href = "dog-toys.php";
            }

            else if(value.includes("dog collar") || value.includes("dog collars")){
                window.location.href = "dog-collars.php";
            }

            else if(value.includes("dog bed") || value.includes("dog beds")){
                window.location.href = "dog-beds.php#dog-beds";
            }

            else if(
                value.includes("dog carrier") ||
                value.includes("dog carriers") ||
                value.includes("dog bag") ||
                value.includes("travel bag")
            ){
                window.location.href = "dog-beds.php#dog-carriers";
            }

            else if(value.includes("dog clothes")){
                window.location.href = "dog-clothes.php";
            }

            else if(value.includes("dog")){
                window.location.href = "dog.php";
            }

            else if(
                value.includes("bird cage") ||
                value.includes("bird cages") ||
                value.includes("bird nests") ||
                value.includes("nest")
            ){
                window.location.href = "bird-cages.php";
            }

            else if(value.includes("bird food") || value.includes("bird snacks")){
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

            else if(value.includes("fish food")){
                window.location.href = "fish-food.php#fish-food";
            }

            else if(
                value.includes("filters") ||
                value.includes("fish filter") ||
                value.includes("tank filter")
            ){
                window.location.href = "fish-filter.php#fish-filters";
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
                value.includes("lighting") ||
                value.includes("tank lights") ||
                value.includes("fish decor") ||
                value.includes("tank decorations") ||
                value.includes("decorations")
            ){
                window.location.href = "fish-decoration.php#fish-decor";
            }

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
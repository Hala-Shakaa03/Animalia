<?php
session_start();
include "db.php";

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
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
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
                <li><a href="#">Shop</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Offers</a></li>
                <li><a href="#">About</a></li>
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

        <div class="order-summary">

            <h2>Order Summary</h2>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>₪<?php echo $subtotal; ?></span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>₪<?php echo $subtotal > 0 ? 6 : 0; ?></span>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <span>₪<?php echo $subtotal > 0 ? $subtotal + 6 : 0; ?></span>
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

                <div class="promo-input">
                    <input type="text" placeholder="Enter code">
                    <button>Apply</button>
                </div>

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
            <a href="#">Customer Help</a>
            <a href="contact.php">Contact Us</a>
            <a href="#">Refund & Returns</a>
        </div>

        <div class="footer-box">
            <h3>Follow</h3>
            <a href="#">Instagram</a>
            <a href="#">TikTok</a>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
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
</body>
</html>
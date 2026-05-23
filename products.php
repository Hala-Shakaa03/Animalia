<?php

$conn = mysqli_connect("localhost", "root", "", "animalia_db");

if(!$conn){
    die("Connection Failed");
}

$product_query  = mysqli_query($conn,
        "SELECT * FROM products");

$products_count = mysqli_num_rows($product_query);




$category_query = mysqli_query($conn,
        "SELECT DISTINCT category FROM products");

$categories_count = mysqli_num_rows($category_query);



$active_query = mysqli_query($conn,
        "SELECT * FROM products WHERE stock > 0");

$active_count = mysqli_num_rows($active_query);


$sales_query = mysqli_query($conn,
        "SELECT SUM(total) AS total_sales FROM orders");

$fetch_sales = mysqli_fetch_assoc($sales_query);

$total_sales = $fetch_sales['total_sales'];

if($total_sales == null){
    $total_sales = 0;
}
$query = "SELECT * FROM products WHERE 1";

if(isset($_GET['search']) && $_GET['search'] != ""){

    $search = $_GET['search'];

    $query .= " AND name LIKE '%$search%'";
}

if(isset($_GET['category']) && $_GET['category'] != "All Categories"){

    $category = $_GET['category'];

    $query .= " AND category='$category'";
}

if(isset($_GET['status'])){

    if($_GET['status'] == "Active"){

        $query .= " AND stock > 0";
    }

    if($_GET['status'] == "Out Of Stock"){

        $query .= " AND stock = 0";
    }
}

$select_products = mysqli_query($conn , $query);
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query($conn,
            "DELETE FROM products WHERE id='$id'");

    header("Location: products.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Manager</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .logout-btn{
            text-decoration:none;
            color:white;
            padding:18px 22px;
            border-radius:18px;
            font-size:18px;
            display:flex;
            align-items:center;
            gap:15px;
            margin-top:0px;
            transition:.3s;
        }

        .logout-btn:hover{
            background:#f3d7a1;
            color:#4b3527;
        }
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            background:#f7f2ec;
            display:flex;
            min-height:100vh;
            color:#4b3527;
        }

        /* SIDEBAR */

        .sidebar{
            width:270px;
            background:linear-gradient(to bottom,#4b3527,#7a4f2f);
            padding:35px 22px;
            color:white;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:50px;
        }

        .logo h2{
            font-size:40px;
            font-weight:700;
        }

        .logo i{
            font-size:34px;
            color:#f3d7a1;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:18px;
        }

        .menu a{
            text-decoration:none;
            color:white;
            padding:18px 22px;
            border-radius:18px;
            display:flex;
            align-items:center;
            gap:15px;
            font-size:18px;
            transition:.3s;
        }

        .menu a:hover,
        .menu a.active{
            background:#f3d7a1;
            color:#4b3527;
        }

        /* MAIN */

        .main{
            flex:1;
            padding:35px;
        }

        /* TOPBAR */

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:35px;
        }

        .topbar h1{
            font-size:42px;
        }

        .top-right{
            display:flex;
            align-items:center;
            gap:18px;
        }

        .search-box{
            background:white;
            width:340px;
            padding:15px 20px;
            border-radius:999px;
            display:flex;
            align-items:center;
            gap:10px;
            box-shadow:0 5px 20px rgba(0,0,0,.05);
        }

        .search-box input{
            border:none;
            outline:none;
            width:100%;
            font-size:15px;
            background:transparent;
        }

        .icon-circle{
            width:55px;
            height:55px;
            border-radius:50%;
            background:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:20px;
            box-shadow:0 5px 20px rgba(0,0,0,.05);
            cursor:pointer;
        }

        /* STATS */

        .stats{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:25px;
            margin-bottom:35px;
        }

        .card{
            background:white;
            padding:28px;
            border-radius:28px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .card-top{
            display:flex;
            align-items:center;
            gap:18px;
            margin-bottom:20px;
        }

        .card-icon{
            width:70px;
            height:70px;
            border-radius:50%;
            background:#f7f2ec;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
            color:#8b5e3c;
        }

        .card h3{
            color:#8b5e3c;
            font-size:18px;
            margin-bottom:8px;
        }

        .card h2{
            font-size:40px;
        }

        /* PRODUCT BOX */

        .products-box{
            background:white;
            border-radius:30px;
            padding:30px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .products-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .products-header h2{
            font-size:34px;
        }

        .add-btn{
            border:none;
            background:#7a4f2f;
            color:white;
            padding:15px 24px;
            border-radius:16px;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
            text-decoration:none;
            display:flex;
            align-items:center;
            gap:10px;

        }

        .add-btn:hover{
            background:#4b3527;
        }

        /* FILTERS */

        .filters{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            margin-bottom:25px;
        }

        .filter-search{
            background:#f7f2ec;
            padding:14px 20px;
            border-radius:16px;
            display:flex;
            align-items:center;
            gap:10px;
            width:350px;
        }

        .filter-search input{
            border:none;
            outline:none;
            width:100%;
            background:transparent;
            font-size:15px;
        }

        .filter-right{
            display:flex;
            gap:15px;
        }

        select{
            border:none;
            outline:none;
            background:#f7f2ec;
            padding:14px 20px;
            border-radius:16px;
            font-size:15px;
            color:#4b3527;
        }

        /* TABLE */

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            text-align:left;
            padding-bottom:18px;
            color:#8b5e3c;
            font-size:16px;
        }

        table td{
            padding:22px 0;
            border-top:1px solid #eee;
        }

        .product-info{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .product-img{
            width:70px;
            height:70px;
            border-radius:16px;
            background:#f7f2ec;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:26px;
            color:#8b5e3c;
        }

        .status{
            padding:8px 18px;
            border-radius:999px;
            font-size:14px;
            font-weight:600;
            display:inline-block;
        }

        .active{
            background:#dff5e3;
            color:#2d8a46;
        }

        .out{
            background:#ffe0e0;
            color:#d63a3a;
        }

        .actions{
            display:flex;
            gap:12px;
        }

        .action-btn{
            width:42px;
            height:42px;
            border-radius:12px;
            border:none;
            cursor:pointer;
            background:#f7f2ec;
            color:#4b3527;
            font-size:16px;
            transition:.3s;

            display:flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
        }

        .action-btn:hover{
            background:#7a4f2f;
            color:white;
        }

        @media(max-width:1200px){

            .stats{
                grid-template-columns:repeat(2,1fr);
            }

            .filters{
                flex-direction:column;
                align-items:flex-start;
            }
        }

        @media(max-width:850px){

            body{
                flex-direction:column;
            }

            .sidebar{
                width:100%;
            }

            .stats{
                grid-template-columns:1fr;
            }

            .topbar{
                flex-direction:column;
                align-items:flex-start;
                gap:20px;
            }

            .search-box{
                width:100%;
            }

            .filter-search{
                width:100%;
            }

            table{
                display:block;
                overflow-x:auto;
            }
        }

    </style>
</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-paw"></i>
        <h2>Animalia</h2>
    </div>

    <div class="menu">

        <a  href="../../../Users/AWE/PhpstormProjects/Animalia/dash.php">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a  href="products.php" class="active">
            <i class="fa-solid fa-box"></i>
            Products
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/Categories.php" >
            <i class="fa-solid fa-layer-group"></i>
            Categories
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/orders.php"  >
            <i class="fa-solid fa-cart-shopping"></i>
            Orders
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/customer.php">
            <i class="fa-solid fa-users"></i>
            Customers
        </a>

        <a href="../../../Users/AWE/PhpstormProjects/Animalia/messages.php">
            <i class="fa-solid fa-envelope"></i>
            Messages
        </a>
        <a href="settings.php">
            <i class="fa-solid fa-gear"></i>
            Settings
        </a>
        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>
    </div>

</div>

<!-- MAIN -->

<div class="main">

    <!-- TOPBAR -->

    <div class="topbar">

        <h1>Products</h1>

        <div class="top-right">




        </div>

    </div>

    <!-- STATS -->

    <div class="stats">

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-box"></i>
                </div>

                <div>
                    <h3>Total Products</h3>
                    <h2><?php echo $products_count; ?></h2>                </div>

            </div>

        </div>

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-tags"></i>
                </div>

                <div>
                    <h3>Categories</h3>
                    <h2><?php echo $categories_count; ?></h2>                </div>

            </div>

        </div>

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>

                <div>
                    <h3>Total Sales</h3>
                    <h2>$<?php echo $total_sales; ?></h2>                </div>

            </div>

        </div>

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

                <div>
                    <h3>Active Products</h3>
                    <h2><?php echo $active_count; ?></h2>                </div>

            </div>

        </div>

    </div>

    <!-- PRODUCTS TABLE -->

    <div class="products-box">

        <div class="products-header">

            <h2>Manage Products</h2>

            <a href="../../../Users/AWE/PhpstormProjects/Animalia/add_product.php" class="add-btn">
                <i class="fa-solid fa-plus"></i>
                Add Product
            </a>

        </div>

        <!-- FILTERS -->
        <form method="GET" class="filters">

            <div class="filter-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                        type="text"
                        name="search"
                        placeholder="Search products...">

            </div>

            <div class="filter-right"><select name="category" onchange="this.form.submit()">

                    <option
                            <?php if(!isset($_GET['category']) || $_GET['category']=="All Categories") echo "selected"; ?>>
                        All Categories
                    </option>

                    <option
                            <?php if(isset($_GET['category']) && $_GET['category']=="Dogs") echo "selected"; ?>>
                        Dogs
                    </option>

                    <option
                            <?php if(isset($_GET['category']) && $_GET['category']=="Cats") echo "selected"; ?>>
                        Cats
                    </option>

                    <option
                            <?php if(isset($_GET['category']) && $_GET['category']=="Birds") echo "selected"; ?>>
                        Birds
                    </option>

                </select>
                <select name="status" onchange="this.form.submit()">

                    <option
                            <?php if(!isset($_GET['status']) || $_GET['status']=="All Status") echo "selected"; ?>>
                        All Status
                    </option>

                    <option
                            <?php if(isset($_GET['status']) && $_GET['status']=="Active") echo "selected"; ?>>
                        Active
                    </option>

                    <option
                            <?php if(isset($_GET['status']) && $_GET['status']=="Out Of Stock") echo "selected"; ?>>
                        Out Of Stock
                    </option>

                </select>

            </div>

        </form>
        <!-- TABLE -->

        <table>

            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

                        <?php

                        while($fetch_product = mysqli_fetch_assoc($select_products)){

                            ?>

                            <tr>

                                <td>

                                    <div class="product-info">

                                        <div class="product-img">

                                            <?php

                                            if($fetch_product['category'] == "Dogs"){
                                                echo '<i class="fa-solid fa-dog"></i>';
                                            }
                                            elseif($fetch_product['category'] == "Cats"){
                                                echo '<i class="fa-solid fa-cat"></i>';
                                            }
                                            else{
                                                echo '<i class="fa-solid fa-paw"></i>';
                                            }

                                            ?>

                                        </div>

                                        <div>
                                            <h4><?php echo $fetch_product['name']; ?></h4>
                                            <span>SKU: <?php echo $fetch_product['id']; ?></span>
                                        </div>

                                    </div>

                                </td>

                                <td><?php echo $fetch_product['category']; ?></td>

                                <td>₪<?php echo $fetch_product['price']; ?></td>

                                <td><?php echo $fetch_product['stock']; ?></td>

                                <td>

                                    <?php

                                    if($fetch_product['stock'] > 0){

                                        echo "<span class='status active'>Active</span>";

                                    }else{

                                        echo "<span class='status out'>Out Of Stock</span>";

                                    }

                                    ?>

                                </td>

                                <td>

                                    <div class="actions">
                                        <a
                                                href="edit_product.php?id=<?php echo $fetch_product['id']; ?>"
                                                class="action-btn">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>
                                        <a
                                                href="?delete=<?php echo $fetch_product['id']; ?>"
                                                class="action-btn">

                                            <i class="fa-solid fa-trash"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                            <?php
                        }
                        ?>

                    </table>

                </div>



            </body>
            </html>

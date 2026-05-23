<?php

$conn = mysqli_connect("localhost","root","","animalia_db");

if(!$conn){
    die("Connection Failed");
}





$total_categories_query = mysqli_query($conn,

"SELECT * FROM categories");

$total_categories = mysqli_num_rows($total_categories_query);



$total_products_query = mysqli_query($conn,

"SELECT * FROM products");

$total_products = mysqli_num_rows($total_products_query);



if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query($conn,

    "DELETE FROM categories
    WHERE id='$delete_id'");

    header("Location: categories.php");
}



$categories_query = mysqli_query($conn,

"SELECT * FROM categories");
if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query($conn,

            "DELETE FROM categories
    WHERE id='$delete_id'");

    header("Location: categories.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Manager</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

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

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:35px;
        }

        .topbar h1{
            font-size:42px;
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
            background:transparent;
            font-size:15px;
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

        /* TABLE BOX */

        .categories-box{
            background:white;
            border-radius:30px;
            padding:30px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .box-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .box-header h2{
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
        }

        .add-btn:hover{
            background:#4b3527;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            text-align:left;
            padding-bottom:18px;
            color:#8b5e3c;
        }

        table td{
            padding:22px 0;
            border-top:1px solid #eee;
        }

        .category-info{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .category-img{
            width:65px;
            height:65px;
            border-radius:18px;
            background:#f7f2ec;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:28px;
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

        .hidden{
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
        }

        .action-btn:hover{
            background:#7a4f2f;
            color:white;
        }

        @media(max-width:1200px){

            .stats{
                grid-template-columns:repeat(2,1fr);
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

        <a  href="dash.php">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a  href="products.php" >
            <i class="fa-solid fa-box"></i>
            Products
        </a>

        <a href="Categories.php" class="active">
            <i class="fa-solid fa-layer-group"></i>
            Categories
        </a>

        <a href="orders.php"  >
            <i class="fa-solid fa-cart-shopping"></i>
            Orders
        </a>

        <a href="customer.php">
            <i class="fa-solid fa-users"></i>
            Customers
        </a>

        <a href="messages.php">
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

    <div class="topbar">

        <h1>Categories</h1>

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search categories...">
        </div>

    </div>

    <!-- STATS -->

    <div class="stats">

        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div>
                    <h3>Total Categories</h3>
                    <h2>12</h2>
                </div>

            </div>

        </div>




        <div class="card">

            <div class="card-top">

                <div class="card-icon">
                    <i class="fa-solid fa-box"></i>
                </div>

                <div>
                    <h3>Total Products</h3>
                    <h2>128</h2>
                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->

    <div class="categories-box">

        <div class="box-header">

            <h2>All Categories</h2>

            <button class="add-btn">
                <i class="fa-solid fa-plus"></i>
                Add Category
            </button>

        </div>

        <table>

            <tr>
                <th>Category</th>
                <th>Slug</th>
                <th>Products</th>
                <th>Actions</th>
            </tr>

            <tr>

                <td>

                    <div class="category-info">

                        <div class="category-img">
                            <i class="fa-solid fa-dog"></i>
                        </div>

                        <div>
                            <h4>Dogs</h4>
                            <span>Pet Products</span>
                        </div>

                    </div>

                </td>

                <td>dogs</td>

                <td>34</td>


                <td>

                    <div class="actions">
                        <a
                                href="edit_categories.php?id=<?php echo $category['id']; ?>"
                                class="action-btn">

                            <i class="fa-solid fa-pen"></i>

                        </a>
                        <a
                                href="categories.php?delete=<?php echo $category['id']; ?>"
                                class="action-btn">

                            <i class="fa-solid fa-trash"></i>

                        </a>
                    </div>

                </td>

            </tr>

            <tr>

                <td>

                    <div class="category-info">

                        <div class="category-img">
                            <i class="fa-solid fa-cat"></i>
                        </div>

                        <div>
                            <h4>Cats</h4>
                            <span>Pet Products</span>
                        </div>

                    </div>

                </td>

                <td>cats</td>

                <td>21</td>


                <td>

                    <div class="actions">

                        <button class="action-btn">
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <button class="action-btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </div>

                </td>

            </tr>

            <tr>

                <td>

                    <div class="category-info">

                        <div class="category-img">
                            <i class="fa-solid fa-fish"></i>
                        </div>

                        <div>
                            <h4>Fish</h4>
                            <span>Aquarium Products</span>
                        </div>

                    </div>

                </td>

                <td>fish</td>

                <td>11</td>



                <td>

                    <div class="actions">

                        <button class="action-btn">
                            <i class="fa-solid fa-pen"></i>
                        </button>

                        <button class="action-btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </div>

                </td>

            </tr>

        </table>

    </div>

</div>

</body>
</html>
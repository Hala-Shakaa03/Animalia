<?php

$conn = mysqli_connect("localhost","root","","animalia_db");

if(!$conn){
    die("Connection Failed");
}

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $insert = mysqli_query($conn,
        "INSERT INTO products(name,category,price,stock)

    VALUES('$name','$category','$price','$stock')");

    if($insert){

        header("Location: products.php");

    }else{

        echo "Failed";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            justify-content:center;
            align-items:center;
            min-height:100vh;
            color:#4b3527;
        }

        .box{
            width:550px;
            background:white;
            padding:40px;
            border-radius:30px;
            box-shadow:0 10px 30px rgba(0,0,0,.05);
        }

        .box h1{
            margin-bottom:30px;
            font-size:38px;
        }

        .input-group{
            margin-bottom:22px;
        }

        .input-group label{
            display:block;
            margin-bottom:10px;
            font-weight:600;
        }

        .input-group input,
        .input-group select{

            width:100%;
            padding:16px;
            border:none;
            outline:none;
            border-radius:16px;
            background:#f7f2ec;
            font-size:15px;
        }

        .btn{
            width:100%;
            border:none;
            padding:16px;
            border-radius:16px;
            background:#7a4f2f;
            color:white;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
        }

        .btn:hover{
            background:#4b3527;
        }

    </style>

</head>
<body>

<div class="box">

    <h1>Add Product</h1>

    <form method="POST">

        <div class="input-group">

            <label>Product Name</label>

            <input
                type="text"
                name="name"
                required>

        </div>

        <div class="input-group">

            <label>Category</label>

            <select name="category">

                <option>Dogs</option>
                <option>Cats</option>
                <option>Birds</option>
                <option>Fish</option>

            </select>

        </div>

        <div class="input-group">

            <label>Price</label>

            <input
                type="number"
                name="price"
                required>

        </div>

        <div class="input-group">

            <label>Stock</label>

            <input
                type="number"
                name="stock"
                required>

        </div>

        <button

            type="submit"
            name="add_product"
            class="btn">

            <i class="fa-solid fa-plus"></i>
            Add Product

        </button>

    </form>

</div>

</body>
</html>
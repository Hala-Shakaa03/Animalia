<?php
$conn = mysqli_connect("localhost","root","","animalia_db");

if(isset($_POST['add_category'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);

    $check = mysqli_query($conn,
    "SELECT * FROM categories WHERE name='$name'");

    if(mysqli_num_rows($check) > 0){

        $message = "Category already exists!";

    }else{

        mysqli_query($conn,
        "INSERT INTO categories(name)
        VALUES('$name')");

        header("Location: categories.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Category</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
    font-family:Poppins,sans-serif;
    background:#f7f2ec;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:white;
    width:420px;
    padding:35px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

h2{
    margin-bottom:25px;
    color:#4b3527;
}

.input-box{
    margin-bottom:20px;
}

.input-box input{
    width:100%;
    padding:15px;
    border:1px solid #ddd;
    border-radius:14px;
    outline:none;
    font-size:15px;
}

button{
    width:100%;
    border:none;
    padding:15px;
    border-radius:14px;
    background:#7a4f2f;
    color:white;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#4b3527;
}

.message{
    background:#ffe0e0;
    color:#c0392b;
    padding:12px;
    border-radius:12px;
    margin-bottom:15px;
}

</style>

</head>
<body>

<div class="box">

    <h2>Add Category</h2>

    <?php
    if(isset($message)){
        echo '<div class="message">'.$message.'</div>';
    }
    ?>

    <form method="POST">

        <div class="input-box">
            <input type="text"
                   name="name"
                   placeholder="Enter category name"
                   required>
        </div>

        <button type="submit" name="add_category">
            Add Category
        </button>

    </form>

</div>

</body>
</html>
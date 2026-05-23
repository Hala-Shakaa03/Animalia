<?php


$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "animalia_db"
);


if (!$conn) {
    die("Connection Failed");
}


include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $phone = $_POST["phone"];

    if ($password != $confirm_password) {
        header("Location: register.php?error=password");
        exit();
    }

    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        header("Location: register.php?error=email");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, password, phone)
            VALUES ('$full_name', '$email', '$hashed_password', '$phone')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php?success=registered");
        exit();
    } else {
        header("Location: register.php?error=1");
        exit();
    }
}

?>
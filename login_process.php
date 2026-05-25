<?php

session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    /* ADMIN LOGIN */
    $admin_sql = "SELECT * FROM admin WHERE email='$email'";
    $admin_result = mysqli_query($conn, $admin_sql);

    if (mysqli_num_rows($admin_result) == 1) {

        $admin = mysqli_fetch_assoc($admin_result);

        if (password_verify($password, $admin["password"])) {

            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_name"] = $admin["username"];

            header("Location: dash.php");
            exit();
        }
    }

    /* USER LOGIN */
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["full_name"];
            $_SESSION["user_email"] = $user["email"];

            header("Location: p1.php");
            exit();

        } else {
            header("Location: login.php?error=wrong");
            exit();
        }

    } else {
        header("Location: login.php?error=notfound");
        exit();
    }
}

?>
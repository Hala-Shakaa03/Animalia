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

$token = $_POST["token"];

$new_password = $_POST["new_password"];
$confirm_password = $_POST["confirm_password"];

if ($new_password != $confirm_password) {

    header("Location: new-password.php?token=$token&error=1");
    exit();
}

$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password='$hashed_password',
            reset_token=NULL
        WHERE reset_token='$token'";

mysqli_query($conn, $sql);

header("Location: login.php?success=reset");
exit();

?>
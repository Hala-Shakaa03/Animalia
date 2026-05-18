<?php

session_start();
include "db.php";

$user_id = $_SESSION["user_id"];

$userQuery =
    "SELECT * FROM users WHERE id='$user_id'";

$userResult =
    mysqli_query($conn, $userQuery);

$user =
    mysqli_fetch_assoc($userResult);

$name =
    $user["full_name"];

$email =
    $user["email"];

$subject =
    $_POST["subject"];

$message =
    $_POST["message"];

$sql =
    "INSERT INTO contact_messages
(full_name,email,subject,message)

VALUES

('$name','$email','$subject','$message')";

mysqli_query($conn, $sql);

header("Location: contact.php?success=1");

?>
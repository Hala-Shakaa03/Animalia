<?php

session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$old_password = $_POST["old_password"];
$new_password = $_POST["new_password"];
$confirm_password = $_POST["confirm_password"];

// التأكد من تطابق الباسورد الجديد
if ($new_password != $confirm_password) {

    header("Location: change-password.php?error=match");
    exit();
}

// جلب الباسورد الحالي من قاعدة البيانات
$sql = "SELECT password FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

// التأكد من الباسورد القديم
if (!password_verify($old_password, $user["password"])) {

    header("Location: change-password.php?error=old");
    exit();
}

// تشفير الباسورد الجديد
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// تحديث الباسورد
$update = "UPDATE users
           SET password='$hashed_password'
           WHERE id='$user_id'";

mysqli_query($conn, $update);

header("Location: profile.php?success=password");
exit();

?>
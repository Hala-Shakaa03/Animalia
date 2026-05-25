<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];

    $check = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) == 1) {

        $token = md5(rand());

        $update = "UPDATE users 
                   SET reset_token='$token'
                   WHERE email='$email'";

        mysqli_query($conn, $update);

        $reset_link = "http://localhost/PetShop-master1/PetShop-master/new-password.php?token=$token";

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = 'animaliaproject4@gmail.com';

            $mail->Password = 'ekra xfuh qgnk zybr';

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('animaliaproject4@gmail.com', 'Animalia');

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = 'Reset Your Password';

            $mail->Body = "
                <h2>Password Reset</h2>
                <p>Click the link below to reset your password:</p>
                <a href='$reset_link'>$reset_link</a>
            ";

            $mail->send();

            header("Location: login.php?success=email");
            exit();

        } catch (Exception $e) {

            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

    } else {

        header("Location: forgot-password.php?error=1");
        exit();
    }
}


//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//
//
//$conn = mysqli_connect(
//    "localhost",
//    "root",
//    "",
//    "animalia_db"
//);
//
//
//if (!$conn) {
//    die("Connection Failed");
//}
//
//
//require 'vendor/autoload.php';
//
//include "db.php";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//
//    $email = $_POST["email"];
//
//    $check = "SELECT * FROM users WHERE email='$email'";
//    $result = mysqli_query($conn, $check);
//
//    if (mysqli_num_rows($result) == 1) {
//
//        $token = md5(rand());
//
//        $update = "UPDATE users
//                   SET reset_token='$token'
//                   WHERE email='$email'";
//
//        mysqli_query($conn, $update);
//
//        $reset_link = "http://localhost/PetShop-master1/PetShop-master/new-password.php?token=$token";
//
//        $mail = new PHPMailer(true);
//
//        try {
//
//            $mail->isSMTP();
//
//            $mail->Host       = 'smtp.gmail.com';
//            $mail->SMTPAuth   = true;
//
//            $mail->Username   = 'animaliaproject4@gmail.com';
//
//            $mail->Password = 'ekra xfuh qgnk zybr';
//
//            $mail->SMTPSecure = 'tls';
//            $mail->Port       = 587;
//
//            $mail->setFrom('animaliaproject4@gmail.com', 'Animalia');
//
//            $mail->addAddress($email);
//
//            $mail->isHTML(true);
//
//            $mail->Subject = 'Reset Your Password';
//
//            $mail->Body = "
//                <h2>Password Reset</h2>
//                <p>Click the link below to reset your password:</p>
//                <a href='$reset_link'>$reset_link</a>
//            ";
//
//            $mail->send();
//
//            header("Location: login.php?success=email");
//            exit();
//
//        } catch (Exception $e) {
//
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
//        }
//
//    } else {
//
//        header("Location: forgot-password.php?error=1");
//        exit();
//    }
//}
//
//?>
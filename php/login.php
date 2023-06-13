<?php
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
global $conn;
session_start();

include '../private/connection.php';

$email = $_POST['email'];

$sql = 'SELECT role FROM users WHERE email = :email';
$query = $conn->prepare($sql);
$query->bindParam(':email', $email);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);

    $verificationCode = mt_rand(100000, 999999);
    $_SESSION['verification_code'] = $verificationCode;
    $_SESSION['email'] = $email;


    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rdivo2023@outlook.com';
        $mail->Password = 'Naoufal2004';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('rdivo2023@outlook.com', 'DiVo');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = 'Your verification code is: ' . $verificationCode;

        $mail->send();

        header('location: ../index.php?page=verification');
    } catch (Exception $e) {
        $_SESSION['melding'] = 'Failed to send the verification code. Error: ' . $mail->ErrorInfo;
        header('location: ../index.php?page=login');
    }
?>

<?php

session_start();

if (isset($_GET['code'])) {
    $verificationCode = $_GET['code'];

    if ($_SESSION['verification_code'] == $verificationCode) {

        $_SESSION['logged_in'] = true;
        header('location: ../index.php?page=homepage');
        exit();
    } else {
        $_SESSION['verification_error'] = 'Invalid verification code. Please try again.';
        header('location: ../index.php?page=verification');
        exit();
    }
} else {
    $_SESSION['verification_error'] = 'Verification code not found. Please try again.';
    header('location: ../index.php?page=homepage');
    exit();
}
?>

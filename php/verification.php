<?php

global $conn;
session_start();

$code = $_POST["code"];
if ($_SESSION['verification_code'] == $code) {

    $_SESSION['loggedin'] = true;
    header('location: ../index.php?page=homepage');
    exit();
} else {
    $_SESSION['verification_error'] = 'Invalid verification code. Please try again.';
    header('location: ../index.php?page=verification');
    exit();
}
?>
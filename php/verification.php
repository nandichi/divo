<?php

global $conn;
session_start();

include '../private/connection.php';

$sql = 'SELECT email FROM admin';
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_COLUMN);

if (isset($_GET['code'])) {
    $verificationCode = $_GET['code'];

    if ($_SESSION['verification_code'] == $verificationCode) {

        if (in_array($_POST['email'], $result)) {
            $_SESSION['admin'] = true;
        }
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
    header('location: ../index.php?page=verification');
    exit();
}
?>

<?php
session_start();

include '../private/connection.php';

$email = $_POST['email'];
$password = $_POST['password'];


$sql = 'SELECT password FROM users WHERE email= :email';
$query = $conn->prepare($sql);
$query->bindParam(':email', $email);
$query->execute();


$result = $query->fetch(PDO::FETCH_ASSOC);
$hashed_password = $result['password'];
$role = $result['role'];


if (password_verify($password, $hashed_password)) {
    if ($role == "admin") {
        $_SESSION['ingelogd'] = true;
        $_SESSION['email'] = $email;
        header('location: ../index.php?page=admin');
    } elseif ($role == "klant") {
        $_SESSION['ingelogd1'] = true;
        $_SESSION['email'] = $email;
        header('location: ../index.php?page=homepage');
    } else {
        $_SESSION['ingelogd1'] = true;
        $_SESSION['email'] = $email;
        header('location: ../index.php?page=homepage');
    }
} else {
    $_SESSION['melding'] = 'Combinatie email en wachtwoord onjuist.';
    header('location: ../index.php?page=login');
}
?>
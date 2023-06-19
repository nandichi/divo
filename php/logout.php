<?php
session_start();
if (isset($_SESSION['role'])) {
    session_destroy();
    header('Location: ../index.php?page=homepage');
    exit();
} elseif (isset($_SESSION['email'])) {
    session_destroy();
    header('Location: ../index.php?page=homepage');
    exit();
} else {
    header('Location: ../index.php?page=homepage');
    exit();
}
?>
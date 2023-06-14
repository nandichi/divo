<?php
session_start();
include '../private/connection.php';

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$partyid = $_POST["partyid"];

$sql = "SELECT firstname, lastname
        FROM member
        WHERE LOWER(firstname) = LOWER(:firstname) AND LOWER(lastname) = LOWER(:lastname)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($stmt->rowCount() == 0) {
    $stmt = $conn->prepare("INSERT INTO member (firstname, lastname, partyid)
                        VALUES(:firstname, :lastname, :partyid)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':partyid', $partyid);
    $stmt->execute();
    header('location: ../index.php?page=partyoverview');
} else {
    $_SESSION['melding'] = 'This member already exists.';
    header('location: ../index.php?page=addmember');
}
<?php
include '../../private/connect.php';

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$memberid = $_POST["memberid"];
$partyid = $_POST["partyid"];




    $stmt = $conn->prepare("UPDATE member  SET firstname = :firstname, lastname = :lastname WHERE memberid = :memberid ");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':memberid', $memberid);
    $stmt->execute();




header('location: ../index.php?page=memberoverview&partyid=' . $partyid );

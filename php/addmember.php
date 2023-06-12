<?php
include '../../private/connect.php';

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$partyid = $_POST["partyid"];

$stmt = $conn->prepare("INSERT INTO member  (firstname,lastname,partyid)
                        VALUES(:firstname,:lastname,:partyid)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':partyid', $partyid);
$stmt->execute();
header('location: ../index.php?page=partyoverview');

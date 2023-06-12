<?php
include '../../private/connect.php';

$partyid = $_GET['partyid'];


$sql = "SELECT memberid
        FROM member where partyid = :partyid
       ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':partyid', $partyid);
$stmt->execute();
$row = $stmt->fetchAll();

foreach ($row as $memberid) {

    $null = NULL;
    $stmt = $conn->prepare("UPDATE member SET partyid = :partyid WHERE memberid =:memberids");
    $stmt->bindParam(':partyid', $null);
    $stmt->bindParam(':memberids', $memberid["memberid"]);
    $stmt->execute();
}

    $stmt1 = $conn->prepare("DELETE FROM party WHERE partyid = :partyid");
    $stmt1->bindParam(':partyid', $partyid);
    $stmt1->execute();



header('location: ../index.php?page=partyoverview');

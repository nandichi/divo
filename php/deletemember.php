<?php
include '../../private/connect.php';

$partyid = $_GET['partyid'];
$memberid= $_GET['memberid'];

$null = 0;
$stmt = $conn->prepare("UPDATE party SET leader = :leader WHERE partyid =:partyid");
$stmt->bindParam(':leader', $null);
$stmt->bindParam(':partyid', $partyid);
$stmt->execute();

$stmt = $conn->prepare("DELETE FROM member WHERE memberid = :memberid");
$stmt->bindParam(':memberid', $memberid);
$stmt->execute();

header('location: ../index.php?page=memberoverview&partyid=' . $partyid );

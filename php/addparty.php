<?php
include '../../private/connect.php';
$name = $_POST['name'];
$seats = $_POST['seats'];
$description = $_POST['description'];
//var_dump($memberid = $_POST["memberid"]);
$leaderid = $_POST['leaderid'];
$logo = base64_encode(file_get_contents($_FILES['logo']['tmp_name']));
if (empty($_POST["leaderid"])){
    $leaderid = NULL;
}else{
    $leaderid = $_POST["leaderid"];

}
if (empty($_POST["memberid"])){
    $memberid = $_POST["leaderid"];
}else{
    $memberid = $_POST["memberid"];

}

$stmt = $conn->prepare("INSERT INTO party  (logo,name,seats,description,leader)
                        VALUES(:logo, :name,:seats,:description,:leader)");
$stmt->bindParam(':logo', $logo);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':seats', $seats);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':leader', $leaderid);

$stmt->execute();

$partyid = $conn->lastInsertId();
if (empty($_POST["memberid"])) {
    $stmt = $conn->prepare("UPDATE member  SET partyid = :partyid WHERE memberid = :memberid ");
    $stmt->bindParam(':partyid', $partyid);
    $stmt->bindParam(':memberid', $memberid);
    $stmt->execute();
}else {


    foreach ($_POST["memberid"] as $memberids) {
        $stmt = $conn->prepare("UPDATE member  SET partyid = :partyid WHERE memberid = :memberid ");
        $stmt->bindParam(':partyid', $partyid);
        $stmt->bindParam(':memberid', $memberids);
        $stmt->execute();
    }

}

header('location: ../index.php?page=partyoverview');

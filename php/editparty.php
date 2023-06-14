<?php
include '../private/connection.php';

$partyid = $_POST["partyid"];
$name = $_POST["name"];
$seats = $_POST["seats"];
$description = $_POST["description"];

if (empty($_POST["memberid"])){
    $leadermemberid = "";
}else{
    $leadermemberid = $_POST["leadermemberid"];

}
//echo "<pre>", print_r($_FILES['logo']['tmp_name']), "</pre>";
if ($_FILES['logo']['tmp_name'] == null) {
    $stmt = $conn->prepare("UPDATE party SET name = :name, seats = :seats, description = :description,leader = :leader WHERE partyid = :partyid");
    $stmt->bindParam(':partyid', $partyid);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':leader', $leadermemberid);
    $stmt->execute();
} else {
    $logo = base64_encode(file_get_contents($_FILES['logo']['tmp_name']));
    $stmt = $conn->prepare("UPDATE party SET logo = :logo, name = :name, seats = :seats, description = :description, leader = :leader WHERE partyid = :partyid");
    $stmt->bindParam(':logo', $logo);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':seats', $seats);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':leader', $leadermemberid);
    $stmt->bindParam(':partyid', $partyid);
    $stmt->execute();
}
if (!empty($_POST["memberid"])) {

    var_dump($_POST["memberid"]);

    $memberIds = implode(',', $_POST['memberid']);

    $stmt = $conn->prepare("UPDATE member SET partyid = NULL WHERE partyid = :partyid AND memberid NOT IN (:memberids)");
    $stmt->bindParam(':partyid', $partyid);
    $stmt->bindParam(':memberids', $memberIds);
    $stmt->execute();
    foreach ($_POST["memberid"] as $memberids) {


        $stmt = $conn->prepare("UPDATE member SET partyid = :partyid WHERE memberid IN (:memberids)");
        $stmt->bindParam(':partyid', $partyid);
        $stmt->bindParam(':memberids', $memberids);
        $stmt->execute();
    }
    $stmt = $conn->prepare("SELECT leader FROM party WHERE partyid = :partyid");
    $stmt->bindParam(':partyid', $partyid);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!in_array($row["leader"], $_POST["memberid"])){

        $null = 0;
        $stmt = $conn->prepare("UPDATE party SET leader = :leader WHERE partyid =:partyid");
        $stmt->bindParam(':leader', $null);
        $stmt->bindParam(':partyid', $partyid);
        $stmt->execute();
    }
}
else{
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

}

header('location: ../index.php?page=partyoverview');
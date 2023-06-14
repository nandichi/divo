<?php
include "../private/connection.php";

$memberid = $_GET["memberid"];
$partyid = $_GET["partyid"];


$sql = "SELECT *
        FROM member where memberid = $memberid
       ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<body>
<div class="container mt-3">
    <h2>Kamerlid Aanpassen</h2>
    <form action="php/editmember.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Voornaam:</label>
            <input type="text" class="form-control" placeholder="Voornaam" name="firstname" value="<?=$row["firstname"]?>">
        </div>
        <div class="mb-3 mt-3">
            <label>Achternaam:</label>
            <input type="text" class="form-control" placeholder="Achternaam" name="lastname" value="<?=$row["lastname"]?>">
        </div>
        <input type="hidden" value="<?=$memberid?>" name="memberid" >
        <input type="hidden" value="<?=$partyid?>" name="partyid" >
        <button name="submit" type="submit" class="btn btn-success">Aanpassen</button>
    </form>
</div>
</body>
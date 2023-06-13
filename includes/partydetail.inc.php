<?php
include '../private/connect.php';



$partyid = $_GET["partyid"];

$sql = "SELECT p.logo, p.name,p.leader,p.seats, p.description, p.partyid, m.memberid, m.firstname, m.lastname 
        FROM party p
        LEFT JOIN member m on p.leader = m.memberid
        where p. partyid = :partyid 
       ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':partyid', $partyid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<table class="table">
    <thead>
    <tr>

        <th scope="col">Logo</th>
        <th scope="col">Naam</th>
        <th scope="col">Voorzitter</th>
        <th scope="col">Voorgaande Zetels</th>
        <th scope="col">Beschrijving</th>
        <th scope="col">Aantal leden</th>




    </tr>
    </thead>

    <tbody>
    <tr>
        <td><img src="data:image/png;base64,<?= $row['logo'] ?>" width="200px" height="200px"></td>
        <td><?= $row['name'] ?></td>
        <td>
        <?php if ($row["leader"] == NULL || $row["leader"] == 0 ){?>
            <?="Er is geen partij voorzitter gekozen"?>
        <?php } else{?>

            <?= $row["firstname"] ?> <?= $row["lastname"] ?></td>
        <?php }?>

        <td><?= $row['seats'] ?></td>
        <td><textarea class="form-control"  disabled aria-label="With textarea" > <?= $row['description']?></textarea></td>



        <?php
        $sql = "SELECT *
        FROM member where partyid = :partyid
       ";
        $stmtmember = $conn->prepare($sql);
        $stmtmember->bindParam(':partyid', $partyid);
        $stmtmember->execute();

        $member = $stmtmember->rowCount()
        ?>

        <td><?=$member?>
            <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=memberoverview&partyid=<?= $partyid ?>'">
                Bekijk leden
            </button>

        </td>


    </tr>
    </tbody>

</table>
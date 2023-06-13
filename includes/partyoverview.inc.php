<?php
include "../private/connect.php";




$sql = "SELECT p.logo, p.name,p.leader,p.seats, p.partyid, m.memberid, m.firstname, m.lastname 
        FROM party p
        LEFT JOIN member m on p.leader = m.memberid";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<table class="table">
    <thead>
    <tr>

        <th scope="col">Partij Logo</th>
        <th scope="col">Partij Naam</th>
        <th scope="col">Partij Voorzitter</th>
        <th scope="col">Voorgaande Zetels</th>
        <th scope="col">Aantal Leden</th>


    </tr>

    </thead>
    <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=addparty'">
        Voeg Partij Toe
    </button>
    <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tbody>

            <tr>
                <td><img src="data:image/png;base64,<?=$row['logo'] ?>" width="200px" height="200px"></td>

                <td><?= $row["name"] ?></td>
                <td>
                    <?php if ($row["leader"] == NULL || $row["leader"] == 0 ){?>
                    <?="Er is geen partij voorzitter gekozen"?>
                    <?php } else{?>

                    <?= $row["firstname"] ?> <?= $row["lastname"] ?></td>
                <?php }?>
                <td><?= $row["seats"] ?></td>
        <?php     $sql = "SELECT *
                FROM member where partyid = :partyid
               ";
        $stmtmember = $conn->prepare($sql);
        $stmtmember->bindParam(':partyid', $row["partyid"]);
        $stmtmember->execute();

        $member = $stmtmember->rowCount()
        ?>
                <td><?=$member?></td>
                <td>
                    <button class="btn btn-primary"
                            onclick="window.location.href='index.php?page=editparty&partyid=<?= $row["partyid"] ?>'">Aanpassen
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger"
                            onclick=" if(confirm('Weet je zeker dat je deze partij wilt verwijderen?'))window.location.href='php/deleteparty.php?partyid=<?= $row["partyid"] ?>'">
                        Verwijder
                    </button>
                </td>
                <td>
                    <button class="btn btn-info"
                            onclick="window.location.href='index.php?page=partydetail&partyid=<?= $row["partyid"] ?>'">Partij Detail
                    </button>
                </td>

            </tr>
            </tbody>
        <?php }
     ?>
</table>



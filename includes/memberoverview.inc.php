<?php
include "../private/connection.php";




$sql = "SELECT p.name, p.partyid, m.memberid, m.firstname, m.lastname 
        FROM party p
        LEFT JOIN member m on p.partyid = m.partyid
        ORDER BY partyid
        ";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
<table class="table">

    <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=addmember'">
        Voeg kamerlid toe
    </button>
    <thead>
    <tr>

        <th scope="col">Voornaam</th>
        <th scope="col">Achternaam</th>
        <th scope="col">Partij </th>


    </tr>

    </thead>

    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tbody>

        <tr>

            <td><?= $row["firstname"] ?></td>
            <td><?= $row["lastname"] ?></td>
            <td><?= $row["name"] ?></td>


        </tr>
        </tbody>
    <?php }
    ?>
</table>



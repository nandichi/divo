<?php
include "../private/connect.php";


$partyid = $_GET["partyid"];
$sql = "SELECT *
        FROM member where partyid = $partyid
       ";
$stmt = $conn->prepare($sql);
$stmt->execute();

?>
<table class="table">
    <thead>
    <tr>

        <th scope="col">Voornaam</th>
        <th scope="col">Achternaam</th>




    </tr>

    </thead>

    <button style="float:right" class="btn btn-success" onclick="window.location.href='index.php?page=addmember'">
        Kamerlid Toevoegen
    </button>
    <?php

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tbody>

            <tr>

                <td><?= $row["firstname"] ?></td>
                <td><?= $row["lastname"] ?></td>

                <td>
                    <button class="btn btn-primary"
                            onclick="window.location.href='index.php?page=editmember&memberid=<?= $row["memberid"] ?>&partyid=<?=$partyid?>'">Aanpassen
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger"
                            onclick=" if(confirm('Weet je zeker dat je deze kamer lid wilt verwijderen?'))window.location.href='php/deletemember.php?memberid=<?= $row["memberid"] ?>&partyid=<?=$partyid?>'">
                        Verwijder
                    </button>
                </td>


            </tr>
            </tbody>
        <?php }
     ?>
</table>

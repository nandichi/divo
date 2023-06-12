<?php
include "../private/connect.php";

$partyid = $_GET["partyid"];

$sql = "SELECT p.name, p.seats, p.description, p.leader, m.memberid, m.firstname, m.lastname
        FROM party p
        LEFT JOIN member m ON m.partyid = p.partyid and p.leader = m.memberid
        WHERE p.partyid = :partyid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':partyid', $partyid);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM member where partyid = :partyid";
$stmttest = $conn->prepare($sql);
$stmttest->bindParam(':partyid', $partyid);
$stmttest->execute();

$memberids = array();

$sql = "SELECT memberid FROM member";
$stmt1 = $conn->prepare($sql);
$stmt1->execute();
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    array_push($memberids, $row1['memberid']);
}
?>

<body>
<div class="container mt-3">
    <h2>Partij Aanpassen</h2>
    <form action="php/editparty.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Partij Logo:</label>
            <input type="file" class="form-control" name="logo">
        </div>
        <div class="mb-3 mt-3">
            <label>Partij Naam:</label>
            <input type="text" class="form-control" placeholder="Partij Naam" name="name" value="<?= $row["name"] ?>">
        </div>
        <div class="mb-3 mt-3">
            <label>Voorgaande Zetels:</label>
            <input type="text" class="form-control" placeholder="Voorgaande Zetels" name="seats"
                   value="<?= $row["seats"] ?>">
        </div>
        <div class="input-group">
            <span class="input-group-text">description</span>
            <textarea class="form-control" name="description"
                      aria-label="With textarea"><?= $row['description'] ?></textarea>
        </div>


        <label>Partij Voorzitter:</label>
        <select class="form-control"  class="form-select" name="leadermemberid">
            <option value="<?= $row["memberid"] ?>"><?= $row["firstname"] ?> <?= $row["lastname"] ?></option>
            <?php while ($rowtest = $stmttest->fetch(PDO::FETCH_ASSOC)) {
                if($rowtest["memberid"] != $row["memberid"]){ ?>
                    <option  value="<?= $rowtest["memberid"] ?>"><?= $rowtest["firstname"] ?> <?= $rowtest["lastname"] ?></option>
                <?php } }  ?>
        </select>
        <?php
        $sql = "SELECT firstname, lastname, memberid
        FROM member
        WHERE partyid = :partyid";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bindParam(':partyid', $partyid);
        $stmt2->execute();

        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div>
                <input type="checkbox" name="memberid[]" value="<?= $row2["memberid"] ?>" <?php if (in_array($row2["memberid"], $memberids)) { ?> checked="checked" <?php } ?>
               >
                <?= $row2["firstname"] ?> <?= $row2["lastname"] ?>
            </div>
        <?php } ?>


        <?php
        $sql = "SELECT firstname, lastname, memberid
                    FROM member
                    WHERE partyid IS NULL";
        $stmt2 = $conn->prepare($sql);
        $stmt2->execute();

        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div>
                <input type="checkbox" name="memberid[]" value="<?= $row2["memberid"] ?>">
                <?= $row2["firstname"] ?> <?= $row2["lastname"] ?>
            </div>
        <?php } ?>

        <input type="hidden" value="<?= $partyid ?>" name="partyid">
        <button name="submit" type="submit" class="btn btn-success">Aanpassen</button>
    </form>
</div>
</body>
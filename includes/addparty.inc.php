<?php
include "../private/connection.php";

$sql = "SELECT *
        FROM member where partyid is NULL
       ";
$stmt = $conn->prepare($sql);
$stmt->execute();

?>


<body>

<div class="container mt-3">
    <h2>Partij Toevoegen</h2>
    <form action="php/addparty.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Partij Logo:</label>
            <input type="file" class="form-control" name="logo">
        </div>
        <div class="mb-3 mt-3">
            <label>Partij Naam:</label>
            <input type="text" class="form-control" placeholder="Partij Naam" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label>Voorgaande Zetels:</label>
            <input type="text" class="form-control" placeholder="Voorgaande Zetels" name="seats">
        </div>
        <div class="mb-3 mt-3">
            <label>description:</label>
            <textarea class="form-control" aria-label="With textarea" placeholder="description" name="description"></textarea>
        </div>



            <?php
            if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>

<div>



                <input type="checkbox" name="memberid[]" value="<?= $row["memberid"] ?>" >
                <?= $row["firstname"] ?> <?= $row["lastname"] ?>
    <input type="radio" name="leaderid" value="<?= $row["memberid"] ?>" >

            <?php }?>
</div>
<?php }else{?>
                <div>
                    <?="Geen kamerleden beschikbaar"?>
                </div>
            <?php } ?>
        <button name="submit" type="submit" class="btn btn-success">Toevoegen</button>
    </form>
</div>
</body>
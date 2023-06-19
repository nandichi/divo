<?php
if (isset($_SESSION['melding'])) {
    echo '<p style = "color:red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);
} ?>

<body>
<div class="container mt-3">
    <h2>Kamerlid Toevoegen</h2>
    <form action="php/addmember.php" method="POST">
        <div class="mb-3 mt-3">
            <label>Voornaam:</label>
            <input type="text" class="form-control" placeholder="Voornaam" name="firstname">
        </div>
        <div class="mb-3 mt-3">
            <label>Achternaam:</label>
            <input type="text" class="form-control" placeholder="Achternaam" name="lastname">
        </div>
        <button name="submit" type="submit" class="btn btn-success">Toevoegen</button>
    </form>
</div>
</body>
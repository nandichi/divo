<div class="loginform">
    <h1>login</h1>
    <?php
    if (isset($_SESSION['melding'])) {
        echo '<p>' . $_SESSION['melding'] . '<p>';
        unset($_SESSION['melding']);
    }
    ?>

    <form action="../php/login.php" method="post">
        <p>email</p>
        <input type="text" name="email" placeholder="email" required>
        <p>wachtwoord</p>
        <input type="password" name="password" placeholder="wachtwoord:" required>
        <button class="btn btn-primary" type="submit">login</button>
    </form>
</div>

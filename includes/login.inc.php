<div class="loginform">
    <h1>login</h1>
    <?php
    if (isset($_SESSION['melding'])) {
        echo '<p>' . $_SESSION['melding'] . '<p>';
        unset($_SESSION['melding']);
    }
    ?>
    <form action="php/login.php" method="post">
        <input type="text" name="email" placeholder="email" required>
        <button class="btn btn-primary" type="submit">login</button>
    </form>
    <a  href="http://localhost:8000/index.php?page=adminlogin">
        Admin Login
    <a>
</div>

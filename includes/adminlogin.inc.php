<?php
if (isset($_SESSION['melding'])) {
    echo '<p>' . $_SESSION['melding'] . '<p>';
    unset($_SESSION['melding']);
}
?>
<div class="loginform">
    <h1>login</h1>

    <form action="php/login.php" method="post">
        <div>
            <input type="text" name="email" placeholder="email" required>
        </div>
        <div>
            <input type="password" name="password" placeholder="password" required>
        </div>
        <input type="hidden" value="adminlogin" name="page">
        <button class="btn btn-primary" type="submit">login</button>
    </form>
</div>
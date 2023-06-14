<?php
$loggedIn = isset($_SESSION['email']);

function generateNavbarLinks() {
    $links = '';

    if ($GLOBALS['loggedIn']) {
        $links .= '
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=homepage">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=logout">Uitloggen</a>
            </li>
        ';
    }
    elseif ($_SESSION["role"] == "admin"){?>

        <li class="nav-item">
            <a class="nav-link" href="index.php?page=homepage">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=partyoverview">Partij Overzicht</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=memberoverview">Kamerleden Overzicht</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=logout">Uitloggen</a>
        </li>
   <?php }
    else {
        $links .= '
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=homepage">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=login">Log In</a>
            </li>
        ';
    }

    return $links;
}
?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav ml-auto">
            <?php echo generateNavbarLinks(); ?>
        </ul>
    </div>
</nav>

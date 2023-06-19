<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <?php if (isset ($_SESSION["loggedin"])){?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=homepage">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../php/logout.php">Uitloggen</a>
                </li>
            <?php }
            elseif (isset($_SESSION["role"])){?>
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
                    <a class="nav-link" href="../php/logout.php">Uitloggen</a>
                </li>
            <?php }
            else {  ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=homepage">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login">Log In</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
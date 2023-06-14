<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiVo</title>
</head>
<body>
<div class="container">
    <h1>welkom op de DiVo website</h1>
    <?php
    if (isset($_SESSION['admin'])) {
        echo 'is admin';
    }
    ?>
    <a class="btn" href="http://localhost:8000/index.php?page=login">
        Klik hier om te stemmen!
    </a>
</div>
</body>
</html>

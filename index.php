<?php
session_start();


if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else{
    $page='Homepage';
}
?>


<!doctype html>
<html lang="en">
<head>
    <title>DiVo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheet.css" rel="stylesheet">

</head>
<body>
<?php include 'includes/navbar.inc.php'; ?>
<div id="container">
    <?php include 'includes/'.$page.'.inc.php'; ?>
</div>

</body>
</html>

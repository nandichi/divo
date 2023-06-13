<div>
<head>
    <title>Verification Code</title>
</head>
<body>
<h1>Verification Code</h1>
<form action="php/login.php" method="POST">
    <label for="code">Enter the verification code:</label>
    <input type="text" id="code" name="code" required>
    <input type="submit" value="Submit">
    <?= var_dump($_SESSION["verification_code"])?>
</form>
</body>
</div>
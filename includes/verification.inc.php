<div>
    <head>
        <title>Verification Code</title>
    </head>
    <body>
    <h1>Verification Code</h1>
    <form class="verbtn" action="php/verification.php" method="POST">
        <label for="code">Enter the verification code:</label>
        <input type="text" id="code" name="code" required>
        <input type="submit" value="Submit">
        <?php
        echo $_SESSION['verification_code'];
        ?>
    </form>
    </body>
</div>
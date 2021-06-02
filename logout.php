<!DOCTYPE html>
<?php
session_start();
session_unset();
session_destroy();
?>

<html>

<head>
    <title>Coffee Talk Blog</title>
    <link rel="stylesheet" href="estils.css">
</head>

<body>
    <header>
        <?php require("footer.php") ?>
    </header>
    
    <div class="centro">
        <h1>Welcome to Coffee Talk Blog</h1>
        <p>You has been logged out properly!</p>
    </div>
</body>

</html>
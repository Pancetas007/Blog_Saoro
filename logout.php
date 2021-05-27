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
    <div class="centro">
        <div class="footer">
            <ul class="menu">
                <li><a href='login.php'>Login</a></li>
                <li><a href='rss.php'>RSS</a></li>
            </ul>
        </div>
    <h1>Welcome to Coffee Talk Blog</h1>
    <p>You has been logged out properly!</p>
    </div>
</body>

</html>

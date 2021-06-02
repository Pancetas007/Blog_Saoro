<!DOCTYPE html>
<?php
session_start();

require("DOMDocument.php");

if (isset($_POST["register_but"])) {

    $username = filter_input(INPUT_POST, "username");
    $nombre = filter_input(INPUT_POST, "nombre");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $password2 = filter_input(INPUT_POST, "password2");

    if ($password == $password2) {
        //crear usuari
        $stmt = $pdo->prepare("INSERT INTO usuari (nomusu, userusu, passusu, emailusu)
        VALUES (:nomusu, :userusu, :passusu, :emailusu)");

        $stmt->bindValue("nomusu", $nombre);
        $stmt->bindValue("userusu", $username);
        $stmt->bindValue("passusu", $password);
        $stmt->bindValue("emailusu", $email);

        $stmt->execute();

        $_SESSION['message'] = "Registrat correctament";
        $_SESSION['username'] = $username;
        header("location: login.php");
    } else {
        //error
        $_SESSION['message'] = "Les contrasenyes son diferents";
    }
}
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

        <form class="table" action="register.php" method="post">
            <h5>Formulario Register</h5>
            <input class="controls" type="text" name="nombre" value="" placeholder="Nom">
            <input class="controls" type="text" name="username" value="" placeholder="Usuari">
            <input class="controls" type="text" name="email" value="" placeholder="Email">
            <input class="controls" type="password" name="password" value="" placeholder="Contrasenya">
            <input class="controls" type="password" name="password2" value="" placeholder="Repetir Contrasenya">
            <input class="buttons" type="submit" name="register_but" value="Register">
        </form>

        <div> <img src="java.png" alt="img" /> </div>
    </div>
</body>

</html>
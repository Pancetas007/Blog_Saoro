<?php
// activem la gestió de sessions
session_start();
$error = "";
$fullname = "";


// Si el formulari s'ha enviat el gestionem
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // indiquem que s'ha enviat un formulari
    $isFormSubmitted = true;
    // obtinc usuari i contrasenya
    $user = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");
    // TODO: Implementar la connexió a la base de dades
    require("DOMDocument.php");
    // TODO: Implementar la consulta
    $stmt = $pdo->prepare("SELECT * FROM usuari WHERE userusu=:username");
    $stmt->bindValue('username', $user);
    $stmt->execute();


    // comprove l'usuari i la contrasenya
    $row = $stmt->fetch();
    if (empty($row)) {
        $error = "Login error";
    } else {
        if ($row["passusu"] == $password) {
            $authenticatedUser = true;
        }
    }
    // TODO: comprovar el resultat de la consulta
    if ($user == "admin" && $password == "admin") {
        $fullname = "Admin admin";

        // s'ha autenticat correctament
        $authenticatedUser = true;

        // creem una variable de sessió anomenada user
        $_SESSION["user"] = $row["codusu"];
    } else {
        $error = "Login error";
    }
}
// si no s'ha enviat ho indiquem
else {
    $isFormSubmitted = false;
}
?>

<html>

<head>
    <title>Coffee Talk Blog</title>
    <link rel="stylesheet" href="estils.css">
</head>

<body>
    <div class="centro">

        <div class="footer">
            <?php require("footer.php") ?>
        </div>

        <h1>Welcome to Coffee Talk Blog</h1>

        <div class="login">
            <?php if ($isFormSubmitted) : ?>
                <?php if (empty($error)) : ?>
                    <p>Login successful. Great to see you back <?= $fullname ?></p>
                <?php else : ?>
                    <p>Error: <?= $error ?>. <a href="login.php">Try again</a></p>
                <?php endif; ?>
            <?php else : ?>

                <form class="table" action="login.php" method="post">
                    <div>
                        <label>Username:</label>
                        <input type="text" name="username" value="" />
                    </div>
                    <div>
                        <label>Password:</label>
                        <input type="text" name="password" value="" />
                    </div>
                    <input type="submit" value="login">
                </form>
            <?php endif; ?>
        </div>
        <div> <img src="java.png" alt="img" /> </div>
    </div>
</body>

</html>
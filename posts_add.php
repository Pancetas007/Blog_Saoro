<?php
// activem la gestió de sessions
session_start();
$loggedUser = $_SESSION["user"] ?? "";

// si l'usuari no ha iniciat sessió l'enviem a la pàgina de login
if (empty($loggedUser)) {
    header("Location: login.php");
}

// TODO: 1. Inicialitzar variables
$isValid = false;
$isPost = false;
// TODO: 2. Comprovar el mètode de sol·licitud
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO: 2.2. Processar el formulari
    $isPost = true;

    $titart = filter_input(INPUT_POST, "titart");
    $bodyart = filter_input(INPUT_POST, "bodyart");
    $codcat = filter_input(INPUT_POST, "codcat");

    $isValid = true;

    //Comprovacio de que cap dels camps esta buits 
    if (empty($titart)) {
        $isValid = false;
    }

    if (empty($bodyart)) {
        $isValid = false;
    }

    if (empty($codcat)) {
        $isValid = false;
    }

    if ($isValid === true) {

        //Conexió a la base de dades
        require("DOMDocument.php");

        $codusu = $_SESSION["user"];
        $datart = date("Y-m-d");

        //Implementacio de la consulta
        $stmt = $pdo->prepare("INSERT INTO article (titart, bodyart,codcat, codusu, datart)
            VALUES (:titart,:bodyart,:codcat,:codusu,:datart)");

        //Asignar valors als paràmetres
        $stmt->bindValue("titart", $titart);
        $stmt->bindValue("bodyart", $bodyart);
        $stmt->bindValue("codcat", $codcat);
        $stmt->bindValue("codusu", $codusu);
        $stmt->bindValue("datart", $datart);

        $stmt->execute();

        $newId = $pdo->lastInsertId();   
    }
    // TODO: 2.2. Obtenir les dades del formulari
    // TODO: 2.3. Validar les dades
    // TODO: 2.3. Comprovar si hi ha algún error de validació        
    // TODO: 2.3.2. Inserir en la base de dades
} else {
    require("DOMDocument.php");

    $stmt = $pdo->prepare("SELECT * FROM categoria, article WHERE categoria.codcat = article.codcat");
    $stmt->execute();

    $categories = $stmt->fetchAll();
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

        <?php if ($isPost === false) : ?>

            <div id="add">
                <!--TODO: 2.1. Mostrar formulari //-->
                <form acction="post_add.php" method="post">
                    <p>Titol de l'article <input type="text" name="titart"></p>
                    <p>Cos de l'article</p>
                    <textarea name="bodyart" rows="10" cols="45" placeholder="Introdueix el cos del article..."></textarea>
                    <p>Categoria</p>
                    <select name="codcat">
                        <?php foreach ($categories as $categoria) : ?>
                            <option value="<?= $categoria["codcat"] ?>"><?= $categoria["nomcat"] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p><input type="submit" value="Enviar"></p>
                </form>
            </div>
        <?php else : ?>

            <!--TODO: 2.3.1. Mostrar errors de validació //-->
            <?php if ($isValid === true) : ?>
                <p>S'han creat el post amb exit</p>
                <p><a href='posts_edit.php?id=<?=$newId?>'>Edit</a> || <a href='posts_delete.php'>Delete</a> || <a href='comments_add.php'>Add a comment</a></p>
            <?php else : ?>
                <p>No s'ha creat el post</p>
            <?php endif; ?>
            <!--TODO: 2.3.3. Mostrar missatge de confirmació //-->
        <?php endif; ?>
    </div>
</body>

</html>
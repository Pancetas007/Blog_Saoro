<?php
session_start();
$loggedUser = $_SESSION["user"] ?? "";
// TODO: Implementar la connexió a la base de dades
require("DOMDocument.php");
// TODO: Implementar la consulta
$stmt = $pdo->prepare("SELECT * FROM article INNER JOIN categoria ON article.codcat = categoria.codcat INNER JOIN usuari ON usuari.codusu = article.codusu  ORDER BY datart DESC");
$stmt->execute();

//TODO: Esperrem més d'un registre
$rows = $stmt->fetchAll();

//var_dump($rows); //Mostrem l'array per comprovar que tenim dades
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
        <?php if (empty($loggedUser)) : ?>
            <p>Please <a href="login.php">login</a>.</p>
        <?php else : ?>
            <!--TODO: Show posts -->
            <div id="indice">
                <ul>
                    <?php foreach ($rows as $row) : ?>
                        <div id="flexIndice">
                            <li>
                                <a href="posts_show.php?id=<?= $row["codart"] ?>"><?= $row["titart"] ?></a> by <strong><?= $row["nomusu"] ?></strong> from <strong><?= $row["nomcat"] ?></strong>
                            </li>
                        </div>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div id="addPost">
                <p>Clic to <a href="posts_add.php">add</a> a posting.</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
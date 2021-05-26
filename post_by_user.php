<?php

// TODO: Obtenir l'id enviat pel query string
$id = $_GET["id"];
//Implementar la consulta
require("DOMDocument.php");

$stmt = $pdo->prepare("SELECT * FROM article, categoria, usuari WHERE article.codcat = categoria.codcat AND article.codusu = usuari.codusu AND article.codusu=:codi ORDER BY datart DESC");
$stmt->bindValue("codi", $id);
$stmt->execute();

$articles = $stmt->fetchAll();

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
    <!--TODO: Show posts -->

    <div id="user">
    <h2>Publicat per <?= $articles[0]["nomusu"] ?></h2>

    <ul>
        <?php foreach ($articles as $article) : ?>
        <div id="flexIndice">
            <li>
                <a href="posts_show.php?id=<?= $article["codart"] ?>"><?= $article["titart"] ?></a> from the <?= $article["nomcat"] ?>
            </li>
        </div>
        <?php endforeach; ?>
    </ul>
    </div>
    </div>
</body>

</html>
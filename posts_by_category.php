<?php

// TODO: Obtenir l'id enviat pel query string
$id = $_GET["id"];
//Implementar la consulta
require("DOMDocument.php");

$stmt = $pdo->prepare("SELECT * FROM article, categoria, usuari WHERE article.codcat = categoria.codcat AND article.codusu = usuari.codusu AND categoria.codcat=:codi ORDER BY datart DESC");
$stmt->bindValue("codi", $id);
$stmt->execute();

$artcategories = $stmt->fetchAll();

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
    <div id="user">
    <h2>En la Categoria <?= $artcategories[0]["nomcat"] ?></h2>
    <ul>
        <?php foreach ($artcategories as $catarticle) : ?>
        <div id="flexIndice">
            <li>
                <a href="posts_show.php?id=<?= $catarticle["codcat"] ?>"><?= $catarticle["titart"] ?></a> from the <?= $catarticle["nomusu"] ?>
            </li>
        </div>
        <?php endforeach; ?>
    </ul>
    </div>
    </div>
</body>

</html>
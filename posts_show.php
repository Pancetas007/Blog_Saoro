<?php
// activem la gestió de sessions
session_start();
$loggedUser = $_SESSION["user"] ?? "";
// si l'usuari no ha iniciat sessió l'enviem a la pàgina de login
if (empty($loggedUser)) {
   header("Location: login.php");
}
// TODO: Obtenir l'id enviat pel query string
$id = $_GET["id"]; //25


// TODO: Implementar la consulta
require("DOMDocument.php");

$stmt = $pdo->prepare("SELECT article.*, categoria.nomcat, usuari.nomusu FROM article INNER JOIN categoria 
                        ON article.codcat = categoria.codcat INNER JOIN usuari 
                        ON article.codusu = usuari.codusu WHERE article.codart=:codi");
$stmt->bindValue("codi", $id);
$stmt->execute();

$article = $stmt->fetch();

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
      <!--TODO: Comprovar que l'article existeix //-->
      <?php if (empty($article)) : ?>
         <p>No hi ha ningun article</p>


      <?php else : ?>
         <div id="flexShow">
            <h2><?= $article["titart"] ?></h2>
            <!--TODO: Si existeix caldrà mostrar les dades obtingudes de la base de dades //-->
            <p><?= $article["bodyart"] ?></p>
            <p>Publicat per <strong><a href='post_by_user.php?id=<?= $article["codusu"] ?>'><?= $article["nomusu"] ?></a></strong> en la categoria <strong><a href='posts_by_category.php?id=<?= $article["codcat"] ?>'><?= $article["nomcat"] ?></a></strong> el <strong><?= $article["datart"] ?></strong></p>
         </div>
         <div id="options">
            <p><a href='posts_edit.php?id=<?= $article["codart"] ?>'>Edit</a> || <a href='posts_delete.php?id=<?= $article["codart"] ?>'>Delete</a> || <a href='comments_add.php'>Add a comment</a></p>
         </div>
      <?php endif; ?>
   </div>
</body>

</html>
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
$pdo = new PDO("mysql:host=mysql-server;dbname=coffee-talks;charset-utf8", "root", "secret");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
</head>

<body>
   <h1>Welcome to Coffee Talk Blog</h1>
   <!--TODO: Comprovar que l'article existeix //-->
   <?php if (empty($article)) : ?>
      <p>No hi ha ningun article</p>


   <?php else : ?>

      <h2><?= $article["titart"] ?></h2>
      <!--TODO: Si existeix caldrà mostrar les dades obtingudes de la base de dades //-->
      <p><?= $article["bodyart"] ?></p>
      <p>Publicat per <strong><a href='posts_by_user.php?id=<?= $article["codusu"] ?>'><?= $article["nomusu"] ?></a></strong> en la categoria <strong><a href='posts_by_category.php?id=<?= $article["codcat"] ?>'><?= $article["nomcat"] ?></a></strong> el <strong><?= $article["datart"] ?></strong></p>
      <p><a href='posts_edit.php'>Edit</a> || <a href='posts_delete.php'>Delete</a> || <a href='comments_add.php'>Add a comment</a></p>
   <?php endif; ?>

   <?php require("footer.php") ?>

</body>

</html>
<?php
    if(isset($_SESSION["type"])) {
        if(!$_SESSION["type"] == "administrateur") {
            header('location:index.php');
        }
    } else {
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de modification d'article</title>
    </head>
    <body>
        <form action="/traitement/modif_article.php">
            <input type="text" name="nom" value="<?php if(isset($_GET["nom"])) $_GET["nom"]; ?>">
            <input type="text" name="type" value="<?php if(isset($_GET["type"])) $_GET["type"]; ?>">
            <input type="text" name="description" value="<?php if(isset($_GET["description"])) $_GET["description"]; ?>">
            <input type="text" name="prix" value="<?php if(isset($_GET["prix"])) $_GET["prix"]; ?>">
            <input type="submit" value="Modifier">
        </form>
    </body>
</html>
<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    session_start();
    if(isset($_SESSION["type"])) {
        if(!($_SESSION["type"] == "admin")) {
            header('location:./index.php');
        }
    } else {
        header('location:./index.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de création d'article</title>
        <link rel="stylesheet" href="./css/creation_article.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <form action="./traitement/ajout_article.php" method="POST" enctype="multipart/form-data">
            <h1>Page de création d'article</h1>

            <div id="Nom">
                <label for="nom">Nom</label>
                <input type="text" id="name" name="nom">   
            </div>

            <div id="Prix">
                <label for="prix">Prix</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" name="prix">
            </div>

            <div id="Description">
                <label for="description">Description</label>
                <textarea id="msg" name="description"></textarea>
            </div>

            <div id="Categorie">
                <label for="type">Type</label>
                <input type="text" id="categorie-select" name="type">
            </div>
            
            <div id="Cover">
                <label for="Image">Image (jpg)</label>
                <input type="file"
                    id="article_image" name="image"
                    accept="image/png, image/jpeg">
            </div>

            <div id="creation_button">
                <button type="submit"> Créer </button>
            </div>
            
        </form>
    </body>
</html>
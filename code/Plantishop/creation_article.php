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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de création d'article</title>
        <link rel="stylesheet" href="css/creation_article.css">
    </head>
    <body>
        <form action="traitement/ajout_article.php">
        <h1>Page de création d'article</h1>

            <div id="Nom">
                <label for="name">Nom</label>
                <input type="text" id="name" name="article_name">   
            </div>

            <div id="Prix">
                <label for="password">Prix</label>
                <input type="number" min="0.00" max="10000.00" step="0.01">
            </div>

            <div id="Description">
                <label for="description">Description</label>
                <textarea id="msg" name="article_description"></textarea>
            </div>

            <div id="Categorie">
                <label for="categorie">Type</label>
                <input type="text" id="categorie-select" name="categorie">
            </div>
            
            <div id="Cover">
                <label for="Image">Image</label>
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
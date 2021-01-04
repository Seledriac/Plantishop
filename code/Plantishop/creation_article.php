<?php
    session_start();
    if(isset($_SESSION["type"])) {
        if(!($_SESSION["type"] == "admin")) {
            header('location:./index.php');
            die();
        }
    } else {
        header('location:./index.php');
        die();
    }
    include './header.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de création d'article</title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/creation_article.css">        
        <script src="./librairies/jquery-3.5.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">            
            <form action="./traitement/ajout_article.php" method="POST" enctype="multipart/form-data">
                <h1>Page de création d'article</h1>

                <div id="Nom">
                    <label for="nom">Nom</label>
                    <input type="text" id="name" name="nom" required>   
                </div>

                <div id="Prix">
                    <label for="prix">Prix</label>
                    <input type="number" min="0.00" max="10000.00" step="0.01" name="prix" required>
                </div>

                <div id="Description">
                    <label for="description">Description</label>
                    <textarea id="msg" name="description" required></textarea>
                </div>

                <div id="Categorie">
                    <label for="type">Type</label>
                    <input type="text" id="categorie-select" name="type" required>
                </div>
                
                <div id="Cover">
                    <label for="Image">Image (jpg)</label>
                    <input type="file"
                        id="article_image" name="image"
                        accept="image/jpeg">
                </div>

                <div id="creation_button">
                    <button type="submit"> Créer </button>
                </div>
                
            </form>
        </div>
        <script>
            document.querySelector("#creation_button button").addEventListener('click', function(e) {
                var nom = document.querySelector("input[name=nom]");
                var prix = document.querySelector("input[name=prix]");
                var description = document.querySelector("input[name=description]");
                var type = document.querySelector("input[name=type]");
                nom.style.backgroundColor = 'white';
                prix.style.backgroundColor = 'white';
                description.style.backgroundColor = 'white';
                type.style.backgroundColor = 'white';                    
                if(isNaN(prix)) {
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(type.length > 50){
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(nom.length > 50) {
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(prix.length > 10 || prix.value < 0) {
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(description.length > 500) {
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
            });
        </script>
    </body>
</html>
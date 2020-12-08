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
    </head>
    <body>
        <form action="/traitement/ajout_article.php">
            
        </form>
    </body>
</html>
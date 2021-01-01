<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    $_GET["id_page"] = 1;
    include './header.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plantishop - Tout pour le jardin à prix malin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/accueil.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="produits"></div>
        <script>
            // Requête AJAX qui demande les articles à /traitement/resultats.php
            // Le résultat est utilisé pour faire les liens vers les articles
        </script>
    </body>
</html>
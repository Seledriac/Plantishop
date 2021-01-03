<?php
    $_GET["id_page"] = 4;
    include './header.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Commande</title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/commander.css">
        <script src="./librairies/jquery-3.5.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">
            <form action="commande.php" method="POST">
                <input type="text" name="adresse_facturation" value="<?php if(isset($_SESSION["adresse_facturation"])) $_SESSION["adresse_facturation"]; ?>">
                <input type="text" name="adresse_livraison" value="<?php if(isset($_SESSION["adresse_livraison"])) $_SESSION["adresse_livraison"]; ?>">
                <input type="text" name="num_carte" value="<?php if(isset($_SESSION["num_carte"])) $_SESSION["num_carte"]; ?>">
                <input type="text" name="adresse_facturation" value="<?php if(isset($_SESSION["nom_paiement"])) $_SESSION["nom_paiement"]; ?>">
                <input type="text" name="num_cvv" value="<?php if(isset($_SESSION["num_cvv"])) $_SESSION["num_cvv"]; ?>">
                <input type="submit" value="Confirmer la commande">
            </form>
        </div>
    </body>
</html>
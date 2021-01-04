<?php
    session_start();
    $_GET["id_page"] = 4;
    if(!(isset($_SESSION["id_client"]))) {
        header('location:./page_connexion.php?id_page=4');
        die();
    }
    if(isset($_SESSION["panier"])) {
        if(count($_SESSION["panier"]) == 0) {
            header('location:./panier.php');
            die();
        }
    } else {
        header('location:./panier.php');
        die();
    }
    include './header.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Commande</title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link href="./librairies/bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css" rel="stylesheet">        
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/commander.css">
        <script src="./librairies/jquery-3.5.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">
            <h1>Veuillez renseigner vos coordonnées</h1>
            <form action="./traitement/commande.php" method="POST">                
                <div class="form-group">
                    <label for="adresse_facturation">Adresse de facturation</label>
                    <input type="text" class="form-control" name="adresse_facturation" value="<?php if(isset($_SESSION["adresse_facturation"])){ echo $_SESSION["adresse_facturation"]; }?>">
                </div>
                <div class="form-group">
                    <label for="adresse_livraison">Adresse de livraison</label>
                    <input type="text" class="form-control" name="adresse_livraison" value="<?php if(isset($_SESSION["adresse_livraison"])){ echo $_SESSION["adresse_livraison"]; }?>">
                </div>
                <div class="form-group">
                    <label for="num_cb">Numéro de carte bancaire</label>
                    <input type="text" class="form-control" name="num_cb" value="<?php if(isset($_SESSION["num_cb"])){ echo $_SESSION["num_cb"]; }?>">
                </div>
                <div class="form-group">
                    <label for="nom_cb">Nom</label>
                    <input type="text" class="form-control" name="nom_cb" value="<?php if(isset($_SESSION["nom_cb"])){ echo $_SESSION["nom_cb"]; }?>">
                </div>
                <div class="form-group">
                    <label for="num_cvv">Code CVV</label>
                    <input type="text" class="form-control" name="num_cvv" value="<?php if(isset($_SESSION["num_cvv"])){ echo $_SESSION["num_cvv"]; }?>">
                </div>
                <div id="btn-commander">
                    <button type="submit" class="btn btn-default">Passer la commande</button>
                </diV>
            </form>
        </div>
    </body>
</html>
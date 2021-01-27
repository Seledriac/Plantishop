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
                    <input type="text" class="form-control" name="adresse_facturation" value="<?php if(isset($_SESSION["adresse_facturation"])){ echo $_SESSION["adresse_facturation"]; }?>" required>
                </div>
                <div class="form-group">
                    <label for="adresse_livraison">Adresse de livraison</label>
                    <input type="text" class="form-control" name="adresse_livraison" value="<?php if(isset($_SESSION["adresse_livraison"])){ echo $_SESSION["adresse_livraison"]; }?>" required>
                </div>
                <div class="form-group">
                    <label for="num_cb">Numéro de carte bancaire</label>
                    <input type="text" class="form-control" name="num_cb" value="<?php if(isset($_SESSION["num_cb"])){ echo $_SESSION["num_cb"]; }?>" required>
                </div>
                <div class="form-group">
                    <label for="nom_cb">Nom</label>
                    <input type="text" class="form-control" name="nom_cb" value="<?php if(isset($_SESSION["nom_cb"])){ echo $_SESSION["nom_cb"]; }?>" required>
                </div>
                <div class="form-group">
                    <label for="num_cvv">Code CVV</label>
                    <input type="text" class="form-control" name="num_cvv" value="<?php if(isset($_SESSION["num_cvv"])){ echo $_SESSION["num_cvv"]; }?>" required>
                </div>
                <div id="btn-commander">
                    <button type="submit" class="btn btn-default">Passer la commande</button>
                </diV>
            </form>
        </div>
        <script>
            document.querySelector("#btn-commander button").addEventListener('click', function(e) {
                var adresse_facturation = document.querySelector("input[name=adresse_facturation]");
                var adresse_livraison = document.querySelector("input[name=adresse_livraison]");
                adresse_facturation.style.backgroundColor = 'white';
                adresse_livraison.style.backgroundColor = 'white';
                if(adresse_facturation.value.length > 200) {
                    document.querySelector("input[name=adresse_facturation]").style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(adresse_livraison.value.length > 200) {
                    document.querySelector("input[name=adresse_livraison]").style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }  
                var num_cb = document.querySelector("input[name=num_cb]");
                var nom_cb = document.querySelector("input[name=nom_cb]");
                var num_cvv = document.querySelector("input[name=num_cvv]");
                num_cb.style.backgroundColor = 'white';
                nom_cb.style.backgroundColor = 'white';
                num_cvv.style.backgroundColor = 'white';
                var str = num_cb.value;
                var newStr = str.replace(/-/g, "");
                var newStr2 = newStr.replace(/\s/g, '');
                num_cb.value = newStr2;
                if(isNaN(num_cb.value)) {
                    document.querySelector("input[name=num_cb]").style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(isNaN(num_cvv.value)) {
                    document.querySelector("input[name=num_cvv]").style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                // Fonction trouvée à l'url suivant : https://stackoverflow.com/questions/12310837/implementation-of-luhn-algorithm
                function valid_credit_card(value) {
                    if (/[^0-9-\s]+/.test(value)) return false;
                    var nCheck = 0, nDigit = 0, bEven = false;
                    value = value.replace(/\D/g, "");
                    for (var n = value.length - 1; n >= 0; n--) {
                        var cDigit = value.charAt(n),
                            nDigit = parseInt(cDigit, 10);
                        if (bEven) {
                            if ((nDigit *= 2) > 9) nDigit -= 9;
                        }
                        nCheck += nDigit;
                        bEven = !bEven;
                    }
                    return (nCheck % 10) == 0;
                }
                if(num_cb.value.length != 16 || !(valid_credit_card(num_cb.value))) {
                    document.querySelector("input[name=num_cb]").style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }                                                      
                if(nom_cb.value.length > 100) {
                    document.querySelector("input[name=nom_cb]").style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(num_cvv.value.length != 3) {
                    document.querySelector("input[name=num_cvv]").style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
            });
        </script>
    </body>
</html>
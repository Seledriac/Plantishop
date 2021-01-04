<?php
    session_start();
    $str = "location:page_connexion.php";
    if(!(isset($_SESSION["id_client"]))) {
        $str.='?id_page='.$_GET["id_page"];        
        header($str);
        die();
    }
    $GET_["id_page"] = 5;
    include "./header.php";
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de profil - <?php echo ucfirst($_SESSION["username"]) ?></title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/profil.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
        <script src="./librairies/jquery-3.5.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">
            <nav>
                <div id="infos-perso">
                    <p>Informations personnelles</p>
                </div>
                <div id="adresses">
                    <p>Adresses</p>
                </div>
                <div id="infos-bancaires">
                    <p>Informations bancaires</p>
                </div>
                <div id="commandes">
                    <p>Vos commandes</p>
                </div>
            </nav>
            <section id="page-profil"></section>
        </div>
        <script>
            document.querySelector("#infos-perso p").addEventListener('click', function() {
                $.ajax({
                    type: "GET", 
                    url: "./traitement/get_infos.php",
                    data: window.params,
                    dataType: 'json',
                    success: function(infos) {
                        var conteneur = document.querySelector("#page-profil");
                        var contenu = 
                        '<form action="./traitement/update_mailtel.php" method="POST">'
                        +'<label for="mail">Adresse e-mail</label>'
                        +'<input type="text" name="mail" value="'+ infos.mail +'">'
                        +'<label for="tel">Numéro de téléphone</label>'
                        +'<input type="text" name="tel" value="' + infos.tel  + '">'
                        +'<input id="btn-submit" type="submit" value="Sauvegarder">'
                        +'</form>';
                        contenu += '</table>';
                        conteneur.innerHTML = contenu;
                        document.querySelector("#btn-submit").addEventListener('click', function(e) {
                            var mail = document.querySelector("input[name=mail]");
                            var phone = document.querySelector("input[name=tel]");
                            mail.style.backgroundColor = 'white';
                            phone.style.backgroundColor = 'white';
                            var str = phone.value;
                            var newStr = str.replace(/-/g, "");
                            var newStr2 = newStr.replace(/\s/g, '');
                            phone.value = newStr2;                            
                            var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                            if(!regEx.test(mail.value) || mail.value.length > 100) {
                                console.log("hello");
                                mail.style.backgroundColor = 'red';
                                e.preventDefault();
                                return;
                            }
                            var regEx2 = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
                            if(!regEx2.test(phone.value) || phone.value.length > 100) {
                                console.log("hella");
                                phone.style.backgroundColor = 'red';
                                e.preventDefault();
                                return;
                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) { 
                        console.log(xhr.responseText);
                    }
                });
            });
            document.querySelector("#adresses p").addEventListener('click', function() {
                $.ajax({
                    type: "GET", 
                    url: "./traitement/get_infos.php",
                    data: window.params,
                    dataType: 'json',
                    success: function(infos) {
                        var conteneur = document.querySelector("#page-profil");
                        var contenu = 
                        '<form action="./traitement/update_adresses.php" method="POST">'
                        +'<label for="adresse_facturation">Adresse de facturation</label>'
                        +'<input type="text" name="adresse_facturation" value="'+ infos.adresse_facturation +'">'
                        +'<label for="adresse_livraison">Adresse de livraison</label>'
                        +'<input type="text" name="adresse_livraison" value="' + infos.adresse_livraison + '">'
                        +'<input id="btn-submit" type="submit" value="Sauvegarder">'
                        +'</form>';
                        contenu += '</table>';
                        conteneur.innerHTML = contenu;
                        document.querySelector("#btn-submit").addEventListener('click', function(e) {                
                            var adresse_facturation = document.querySelector("input[name=adresse_facturation]");
                            var adresse_livraison = document.querySelector("input[name=adresse_livraison]");
                            adresse_facturation.style.backgroundColor = 'white';
                            adresse_livraison.style.backgroundColor = 'white';
                            if(adresse_facturation.value.length > 200) {
                                document.querySelector("input[name=adresse_facturation]").style.backgroundColor = 'red';
                                e.preventDefault();
                                return;
                            }
                            if(adresse_livraison.value.length > 200) {
                                document.querySelector("input[name=adresse_livraison]").style.backgroundColor = 'red';
                                e.preventDefault();
                                return;
                            }                            
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) { 
                        console.log(xhr.responseText);
                    }
                });
            });
            document.querySelector("#infos-bancaires p").addEventListener('click', function() {
                $.ajax({
                    type: "GET", 
                    url: "./traitement/get_infos.php",
                    data: window.params,
                    dataType: 'json',
                    success: function(infos) {
                        var conteneur = document.querySelector("#page-profil");
                        var contenu = 
                        '<form action="./traitement/update_paiement.php" method="POST">'
                        +'<label for="num_cb">Numéro de carte bancaire</label>'
                        +'<input type="text" name="num_cb" value="'+ infos.num_cb +'">'
                        +'<label for="nom_cb">Nom</label>'
                        +'<input type="text" name="nom_cb" value="' + infos.nom_cb  + '">'
                        +'<label for="num_cvv">Numéro CVV</label>'
                        +'<input type="text" name="num_cvv" value="' + infos.num_cvv  + '">'
                        +'<input id="btn-submit" type="submit" value="Sauvegarder">'
                        +'</form>';
                        contenu += '</table>';
                        conteneur.innerHTML = contenu;
                        document.querySelector("#btn-submit").addEventListener('click', function(e) {                            
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
                                document.querySelector("input[name=num_cb]").style.backgroundColor = 'red';
                                e.preventDefault();
                                return;
                            }
                            if(isNaN(num_cvv.value)) {
                                document.querySelector("input[name=num_cvv]").style.backgroundColor = 'red';
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
                                document.querySelector("input[name=num_cb]").style.backgroundColor = 'red';
                                e.preventDefault();
                                return;
                            }                                                      
                            if(nom_cb.value.length > 100) {
                                document.querySelector("input[name=nom_cb]").style.backgroundColor = 'red';
                                e.preventDefault();
                                return;
                            }
                            if(num_cvv.value.length != 3) {
                                document.querySelector("input[name=num_cvv]").style.backgroundColor = 'red';
                                e.preventDefault();
                                return;
                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) { 
                        console.log(xhr.responseText);
                    }
                });
            });
            function afficherCommandes() {
                $.ajax({
                    type: "GET", 
                    url: "./traitement/get_commandes.php",
                    data: window.params,
                    dataType: 'json',
                    success: function(commandes) {
                        var conteneur = document.querySelector("#page-profil");
                        conteneur.innerHTML = "";
                        var tableau = document.createElement('table');
                        var tbody = document.createElement('tbody');
                        var entetes = document.createElement('tr');
                        var num_commande = document.createElement('th');
                        var date_commande = document.createElement('th');
                        entetes.id="entetes"
                        num_commande.innerText = "N° de commande";
                        date_commande.innerText = "Date de commande";
                        entetes.appendChild(num_commande);
                        entetes.appendChild(date_commande);
                        tbody.appendChild(entetes);
                        tableau.appendChild(tbody);
                        '<table><tr id="entetes"><th>N° de commande</th><th>Date de commande</th></tr>';
                        for (var i = 0; i < commandes.length; i++) {
                            var tr = document.createElement('tr');
                            var id_commande = document.createElement('td');
                            var lien_commande = document.createElement('a');
                            var date = document.createElement('td');
                            tr.classList.add("commande");
                            id_commande.classList.add("id_commande");
                            lien_commande.href = "./page_commande.php?id_commande=" + parseInt(commandes[i].id_commande) + "\"";
                            lien_commande.innerText = parseInt(commandes[i].id_commande);
                            date.classList.add("date");
                            date.innerText = commandes[i].date;
                            id_commande.appendChild(lien_commande);
                            tr.appendChild(id_commande);
                            tr.appendChild(date);                            
                            tbody.appendChild(tr);
                        }
                        conteneur.appendChild(tableau);
                    },
                    error: function(xhr, ajaxOptions, thrownError) { 
                        console.log(xhr.responseText);
                    }
                });
            }
            afficherCommandes();
            document.querySelector("#commandes p").addEventListener('click', afficherCommandes);
            
        </script>
    </body>
</html>
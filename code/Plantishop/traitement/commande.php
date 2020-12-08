<?php
    $sql = "
    BEGIN;
    INSERT INTO commande(id_client)
    VALUES (". $_SESSION["id_client"] .");";
    foreach($_SESSION["panier"] as $id_article => $nb_articles) {
        $sql = $sql." INSERT INTO ligne (id_commande, id_article, quantite) VALUES(LAST_INSERT_ID(),".$id_article.", ".$nb_articles.");";
    }
    $sql = $sql." REPLACE INTO utilisateur (adresse_facturation, adresse_livraison, num_carte, nom_paiement, num_cvv)
    VALUES(".$_POST["adresse_facturation"].",".$_POST["adresse_livraison"].", ".$_POST["num_cb"].", ".$_POST["nom_cb"].", ".$_POST["num_cvv"]."); COMMIT;";
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = 'pass';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$conn ){
        die('Erreur de connexion : ' . mysqli_error());
    }
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:profil.php');
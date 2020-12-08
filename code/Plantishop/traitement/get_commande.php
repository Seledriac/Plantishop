<?php
    $sql = "
        SELECT article.nom, ligne.quantite, article.prix FROM commande
        INNER JOIN ligne
        ON commande.id_commande = ligne.id_commande
        INNER JOIN article 
        ON ligne.id_article = article.id_article
        WHERE id_commande='".$_GET["id_commande"]."'";
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = 'pass';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$conn ){
        die('Erreur de connexion : ' . mysqli_error());
    }
    $result = mysqli_query($conn, $sql);
    header('Content-Type: application/json');
    while($row = mysqli_fetch_assoc($result)) {
        echo json_encode(array($result)); // On renvoie les résultats sous forme d'objets JS
        // FORMAT D'UN OBJET RENVOYÉ
        //
        // {
        //     {
        //         nom : "Monstera",
        //         quantite : 1,
        //         prix : 17.99,
        //     },
        //     {
        //         nom : "Arbre ombrelle",
        //         quantite : 2,
        //         prix : 39.99,
        //     }
        // }
    }
    mysqli_close($conn);
    die();
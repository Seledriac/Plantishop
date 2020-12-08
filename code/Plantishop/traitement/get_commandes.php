<?php
    $sql = "
        SELECT * FROM commande
        INNER JOIN utilisateur
        ON commande.id_client = client.id_client
        WHERE id_client='".$_SESSION["id_client"]."'";
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
        // Les données sont de la forme :
        // {
        //     id_commande : 1054875643,
        //     id_client : 18,
        //     date : "09/12/2020",
        // }
    }
    mysqli_close($conn);
    die();
<?php
    session_start();
    $scroll_state = $_GET["scroll_state"];
    $sql = "SELECT id_article, nom, prix FROM article LIMIT".$scroll_state.",".str(intval($scroll_state) + 6); // On récupère les articles 6 par 6

    if(isset($_GET["reset"])) { // Si le logo a été cliqué
        unset($_SESSION["type"]);
        unset($_SESSION["prix"]);
    }

    if(isset($_GET["query"])) { // Si c'est une recherche de l'utilisateur
        $sql = $sql." WHERE nom LIKE %".$_GET["query"]."%";
    }
    
    if(isset($_GET["type"])) { // Si l'un des boutons de type de produit du header a été cliqué
        $_SESSION["type"] = $_GET["type"];
        $sql = $sql." WHERE type=".$_GET["type"];
    } else if(isset($_SESSION["type"])) { // Mémoire de l'accumulation des tris
        if(isset($_GET["query"])) { // Si c'est une recherche de l'utilisateur
            $sql = $sql." AND type=".$_SESSION["type"];
        } else {
            $sql = $sql." WHERE type=".$_SESSION["type"];
        }
    }

    if(isset($_GET["tri"])) { // Si l'un des boutons de tris du header a été cliqué (prix ou marque)
        $_SESSION["tri"] = $_GET["tri"];
        $sql = $sql." ORDER BY ".$_GET["tri"];
    }  else if(isset($_SESSION["tri"])) { // Mémoire de l'accumulation des tris
        $sql = $sql." WHERE tri=".$_SESSION["tri"];
    }

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
        //         id_article : 2,
        //         nom : "Monstera",
        //         prix : 17.99,
        //     },
        //     .
        //     etc
        //     .
        //     .
        // }
    }
    mysqli_close($conn);
    die();
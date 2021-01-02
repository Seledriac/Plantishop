<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    session_start();    

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

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $stmt = $mysqli->prepare("SELECT id_article, nom, prix FROM article");
    $nb_produits = $_GET["nb_produits"];
    // $stmt->bind_param('dd', $nb_produits, strval(intval($nb_produits) + 6)); 
    $stmt->execute();
    $result = $stmt->get_result();
    $results = array();
    while($row = $result->fetch_assoc()) {
        array_push($results, $row);        
    }
    // FORMAT D'UN OBJET RENVOYÉ        
    // {
    //     {
    //         id_article : 1,
    //         nom : "Monstera",
    //         prix : 17.99,
    //     },
    //     .
    //     etc
    //     .
    //     .
    // }
    echo json_encode($results); 
    $mysqli->close();
    die();
<?php
    session_start();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $stmt = $mysqli->prepare("INSERT INTO commande(id_client, date) VALUES(?,?);");
    $date = date("Y-m-d");
    $stmt->bind_param("ds", $_SESSION["id_client"], $date);
    $stmt->execute();
    $stmt = $mysqli->prepare("SELECT LAST_INSERT_ID();");
    $stmt->execute();    
    $result = $stmt->get_result();
    $id_commande = $result->fetch_row()[0];
    foreach($_SESSION["panier"] as $id_article => $nb_articles) {
        $stmt = $mysqli->prepare("INSERT INTO ligne(id_commande, id_article, quantite) VALUES (?, ?, ?);");
        $stmt->bind_param("ddd", $id_commande, $id_article, $nb_articles);
        $stmt->execute();
    }
    $stmt = $mysqli->prepare("UPDATE utilisateur SET adresse_facturation=?, adresse_livraison=?, num_cb=?, nom_cb=?, num_cvv=? WHERE id_client=?;");
    $stmt->bind_param("ssssss", $_POST["adresse_facturation"], $_POST["adresse_livraison"], $_POST["num_cb"], $_POST["nom_cb"], $_POST["num_cvv"], $_SESSION["id_client"]);
    $stmt->execute();
    unset($_SESSION["panier"]);
    $stmt = $mysqli->prepare("SELECT * FROM utilisateur WHERE id_client=? LIMIT 1");
    $stmt->bind_param('d', $_SESSION["id_client"]);
    $stmt->execute();
    $result = array_map("utf8_encode", $stmt->get_result()->fetch_assoc());
    $_SESSION["adresse_facturation"] = $result["adresse_facturation"];
    $_SESSION["adresse_livraison"] = $result["adresse_livraison"];
    $_SESSION["num_cb"] = $result["num_cb"];
    $_SESSION["nom_cb"] = $result["nom_cb"];
    $_SESSION["num_cvv"] = $result["num_cvv"];
    header('location:../profil.php');
    die();
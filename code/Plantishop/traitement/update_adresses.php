<?php
    session_start();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $stmt = $mysqli->prepare("UPDATE utilisateur SET adresse_facturation=?, adresse_livraison=? WHERE id_client=?;");
    $stmt->bind_param("ssd", $_POST["adresse_facturation"], $_POST["adresse_livraison"], $_SESSION["id_client"]);
    $stmt->execute();
    $_SESSION["adresse_facturation"] = $_POST["adresse_facturation"];
    $_SESSION["adresse_livraison"] = $_POST["adresse_livraison"];
    header('location:../profil.php');
    die();
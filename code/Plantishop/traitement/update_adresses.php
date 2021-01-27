<?php
    session_start();
    if(!(isset($_SESSION["id_client"]))) {
        header('location:../index.php');
        die();
    }
    if(!(isset($_POST["adresse_facturation"]) && isset($_POST["adresse_livraison"]))) {
        header('location:../index.php');
        die();
    }
    if(!(is_string($_POST['adresse_facturation']) && is_string($_POST['adresse_livraison']))) {
        header('location:../index.php');
        die();
    }
    if(strlen($_POST['adresse_facturation']) > 200 || strlen($_POST['adresse_livraison']) > 200) {
        header('location:../index.php');
        die();
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include '../config.php';
    $mysqli = new mysqli(constant('server') . ':' . constant('mysql_port'), constant('user_sql'), constant('pass_sql'), constant('dbname'));
    $mysqli->set_charset("latin1");
    $stmt = $mysqli->prepare("UPDATE utilisateur SET adresse_facturation=?, adresse_livraison=? WHERE id_client=?;");
    $stmt->bind_param("ssd", $_POST["adresse_facturation"], $_POST["adresse_livraison"], $_SESSION["id_client"]);
    $stmt->execute();
    $_SESSION["adresse_facturation"] = $_POST["adresse_facturation"];
    $_SESSION["adresse_livraison"] = $_POST["adresse_livraison"];
    header('location:../profil.php');
    die();
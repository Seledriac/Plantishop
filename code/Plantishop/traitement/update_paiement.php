<?php
    session_start();
    if(!(isset($_SESSION["id_client"]))) {
        header('location:../index.php');
        die();
    }
    if(!(isset($_POST["num_cb"]) && isset($_POST["nom_cb"]) && isset($_POST["num_cvv"]))) {
        header('location:../index.php');
        die();
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $stmt = $mysqli->prepare("UPDATE utilisateur SET num_cb=?, nom_cb=?, num_cvv=? WHERE id_client=?;");
    $stmt->bind_param("ssd", $_POST["num_cb"], $_POST["nom_cb"], $_POST["num_cvv"], $_SESSION["id_client"]);
    $stmt->execute();
    $_SESSION["num_cb"] = $_POST["num_cb"];
    $_SESSION["nom_cb"] = $_POST["nom_cb"];
    $_SESSION["num_cvv"] = $_POST["num_cvv"];
    header('location:../profil.php');
    die();
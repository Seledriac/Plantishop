<?php
    session_start();
    if(!(isset($_SESSION["id_client"]))) {
        header('location:../index.php');
        die();
    }
    if(!(isset($_POST["mail"]) && isset($_POST["tel"]))) {
        header('location:../index.php');
        die();
    }
    if(!(is_string($_POST['mail']) && is_string($_POST['tel']))) {
        header('location:../index.php');
        die();
    }
    if(strlen($_POST['mail']) > 100 || strlen($_POST['tel']) > 100) {
        header('location:../index.php');
        die();
    }
    if(!preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $_POST['tel'])) {
        header('location:../index.php');
        die();
    }
    if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $_POST['mail'])) {
        header('location:../index.php');
        die();
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $stmt = $mysqli->prepare("UPDATE utilisateur SET mail=?, tel=? WHERE id_client=?;");
    $stmt->bind_param("ssd", $_POST["mail"], $_POST["tel"], $_SESSION["id_client"]);
    $stmt->execute();
    $_SESSION["mail"] = $_POST["mail"];
    $_SESSION["tel"] = $_POST["tel"];
    header('location:../profil.php');
    die();
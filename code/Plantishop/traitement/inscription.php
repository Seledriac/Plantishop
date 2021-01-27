<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    if(!(isset($_POST["user_name"]) && isset($_POST["user_password"]) && isset($_POST["user_email"]) && isset($_POST["phone"]))) {
        header('location:../page_inscription.php');
        die();
    }
    if(!(is_string($_POST['user_name']) && is_string($_POST['user_password']) && is_string($_POST['user_email']) && is_string($_POST['phone']))) {
        header('location:../page_inscription.php');
        die();
    }
    if(strlen($_POST['user_name']) > 50 || strlen($_POST['user_password']) > 50 || strlen($_POST['user_email']) > 100 || strlen($_POST['phone']) > 100) {
        header('location:../page_inscription.php');
        die();
    }
    if(!preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $_POST['phone'])) {
        header('location:../page_inscription.php');
        die();
    }
    if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $_POST['user_email'])) {
        header('location:../page_inscription.php');
        die();
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include '../config.php';
    $mysqli = new mysqli(constant('server') . ':' . constant('mysql_port'), constant('user_sql'), constant('pass_sql'), constant('dbname'));
    $mysqli->set_charset("latin1");
    $sql = "SELECT * FROM utilisateur WHERE username=? AND pass=? LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $_POST["user_name"], $_POST["user_password"]);
    $stmt->execute();
    $result = array_map("utf8_encode", $stmt->get_result()->fetch_assoc());
    if(count($result) > 0) {
        header('location:../page_inscription.php');
        die();
    }
    $sql = "INSERT INTO utilisateur(type, username, pass, mail, tel) VALUES('client', ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    if($_POST["user_password"] != $_POST["user_password_confirmation"]) {
        header("location:./page_inscription.php");
    }
    $stmt->bind_param('ssss', $_POST["user_name"], $_POST["user_password"], $_POST["user_email"], $_POST["phone"]);
    $stmt->execute();    
    if(isset($_POST["id_page"])) { // Redirection vers la page de connexion
        header('location:../profil.php?id_page='.$_POST["id_page"]);
    } else {
        header('location:../profil.php');
    }
    die();    
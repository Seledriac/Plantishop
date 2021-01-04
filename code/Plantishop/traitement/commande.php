<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    session_start();
    if(!(isset($_SESSION["id_client"]) && isset($_POST["adresse_facturation"]) && isset($_POST["adresse_livraison"]) && isset($_POST["num_cb"]) && isset($_POST["nom_cb"]) && isset($_POST["num_cvv"]))) {
        header('location:../index.php');
        die();
    }
    if(!(is_string($_POST['adresse_facturation']) && is_string($_POST['adresse_livraison']) && is_numeric($_POST['num_cb']) && is_string($_POST['nom_cb']) && is_numeric($_POST['num_cvv']))) {
        header('location:../index.php');
        die();
    }
    if(strlen($_POST['adresse_facturation']) > 200 || strlen($_POST['adresse_livraison']) > 200 || strlen($_POST['nom_cb']) > 100 || strlen($_POST['num_cvv']) != 3) {
        header('location:../index.php');
        die();
    }
    function is_valid_luhn($number) {
        settype($number, 'string');
        $sumTable = array(
            array(0,1,2,3,4,5,6,7,8,9),
            array(0,2,4,6,8,1,3,5,7,9));
        $sum = 0;
        $flip = 0;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $sum += $sumTable[$flip++ & 0x1][$number[$i]];
        }
        return $sum % 10 === 0;
    }
    if(!is_valid_luhn($_POST['num_cb'])) {
        header('location:../index.php');
        die();
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $mysqli->query("BEGIN;");
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
        $sql = "UPDATE article set qte_stock = qte_stock - ? WHERE id_article=?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('dd', $nb_articles, $id_article);
        $stmt->execute();
        $sql = "UPDATE article set qte_stock = 0 WHERE id_article=? AND qte_stock < 0;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('d', $id_article);        
        $stmt->execute();
    }    
    $mysqli->query("COMMIT;");
    $stmt = $mysqli->prepare("UPDATE utilisateur SET adresse_facturation=?, adresse_livraison=?, num_cb=?, nom_cb=?, num_cvv=? WHERE id_client=?;");
    $stmt->bind_param("ssssss", $_POST["adresse_facturation"], $_POST["adresse_livraison"], $_POST["num_cb"], $_POST["nom_cb"], $_POST["num_cvv"], $_SESSION["id_client"]);
    $stmt->execute();
    $stmt = $mysqli->prepare("SELECT * FROM utilisateur WHERE id_client=? LIMIT 1");
    $stmt->bind_param('d', $_SESSION["id_client"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = array_map("utf8_encode", $result->fetch_assoc());
    $_SESSION["adresse_facturation"] = $result["adresse_facturation"];
    $_SESSION["adresse_livraison"] = $result["adresse_livraison"];
    $_SESSION["num_cb"] = $result["num_cb"];
    $_SESSION["nom_cb"] = $result["nom_cb"];
    $_SESSION["num_cvv"] = $result["num_cvv"];      
    unset($_SESSION["panier"]);
    header('location:../profil.php');
    die();
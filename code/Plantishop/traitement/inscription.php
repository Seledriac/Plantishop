<?php
    session_start();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $sql = "INSERT INTO utilisateur VALUES(type='client', username=?,  LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    if($_POST["user_password"] != $_POST["user_password_confirmation"]) {
        header("location:./page_inscription.php");
    }
    $stmt->bind_param('sssss', $_POST["user_name"], $_POST["user_password"], $_POST["user_password"], $_POST["user_mail"], $_POST["phone"]);
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $result = array_map("utf8_encode", $stmt->get_result()->fetch_assoc());
    $_SESSION["id_client"] = $result["id_client"];
    $_SESSION["type"] = $result["type"];
    $_SESSION["adresse_facturation"] = $result["adresse_facturation"];
    $_SESSION["adresse_livraison"] = $result["adresse_livraison"];
    $_SESSION["num_cb"] = $result["num_cb"];
    $_SESSION["nom_cb"] = $result["nom_cb"];
    $_SESSION["num_ccv"] = $result["num_ccv"];
    if(isset($_GET["id_page"])) {
        switch($_GET["id_page"]) { // Redirection vers la page précédente
            case 1:
                header('location:./index.php');
                break;
            case 2:
                header('location:./article.php?id_article='.$_GET["id_article"]);
                break;
            case 3:
                header('location:./panier.php');
                break;
            case 4:
                header('location:./commander.php');
                break;
            default:
                break;
        }
    } else {
        header('location:./index.php');
    }
    die();    
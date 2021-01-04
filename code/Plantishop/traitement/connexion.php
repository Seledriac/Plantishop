<?php
    if(!(isset($_POST["user_name"]) && isset($_POST["user_password"]))) { 
        header('location:../index.php');
        die();
    }
    if(!(is_string($_POST["user_name"]) && is_string($_POST["user_password"]))) { 
        header('location:../index.php');
        die();
    }
    session_start();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $sql = "SELECT * FROM utilisateur WHERE username=? AND pass=? LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $_POST["user_name"], $_POST["user_password"]);
    $stmt->execute();
    $result = array_map("utf8_encode", $stmt->get_result()->fetch_assoc());
    if(count($result) < 1) {
        header('location:../page_connexion.php');
        die();
    }
    $_SESSION["id_client"] = $result["id_client"];
    $_SESSION["username"] = $result["username"];
    $_SESSION["type"] = $result["type"];
    $_SESSION["mail"] = $result["mail"];
    $_SESSION["tel"] = $result["tel"];
    $_SESSION["adresse_facturation"] = $result["adresse_facturation"];
    $_SESSION["adresse_livraison"] = $result["adresse_livraison"];
    $_SESSION["num_cb"] = $result["num_cb"];
    $_SESSION["nom_cb"] = $result["nom_cb"];
    $_SESSION["num_cvv"] = $result["num_cvv"];
    if(isset($_POST["id_page"])) { 
        switch($_POST["id_page"]) { // Redirection vers la page précédente
            case 1:
                header('location:../profil.php');
                break;
            case 2:
                header('location:../profil.php');
                break;
            case 3:
                header('location:../profil.php');
                break;
            case 4:
                header('location:../commander.php');
                break;
            case 5:
                header('location:../profil.php');
                break;
            default:
                header('location:../index.php');
                break;
        }
    } else {
        header('location:../profil.php');
    }
    die();
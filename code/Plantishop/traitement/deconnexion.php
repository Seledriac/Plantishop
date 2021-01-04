<?php    
    session_start();
    if(isset($_SESSION["panier"])) {
        $panier = $_SESSION["panier"];
        session_destroy();
        session_start();
        $_SESSION["panier"] = $panier;
    } else {
        session_destroy();
    }
    if(isset($_GET["id_page"])) { 
        switch($_GET["id_page"]) { // Redirection vers la page précédente
            case 1:
                header('location:../index.php');
                break;
            case 2:
                header('location:../article.php?id_article='.$_GET["id_article"]);
                break;
            case 3:
                header('location:../panier.php');
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
        header('location:../index.php');
    }
    die();
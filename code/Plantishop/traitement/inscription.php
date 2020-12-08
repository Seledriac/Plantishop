<?php
    session_start();
    // inscription de l'user avec la db mysql et mise des infos dans la session
    $_SESSION["id_client"] = $id_client;
    $_SESSION["type"] = $type_utilisateur;

    if(isset($_GET["id_page"])) {
        switch($_GET["id_page"]) { // Redirection vers la page précédente
            case 1:
                header('location:index.php');
                break;
            case 2:
                header('location:article.php?id_article='.$_GET["id_article"]);
                break;
            case 3:
                header('location:panier.php');
                break;
            case 4:
                header('location:commander.php');
                break;
            default:
                break;
        }
    } else {
        header('location:index.php');
    }
    die();    
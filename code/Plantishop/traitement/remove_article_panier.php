<?php
    session_start();
    if(!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = array();
    }
    if(isset($_GET['id_article'])) {
        $id_article = $_GET["id_article"];
        if(isset($_SESSION["panier"][$id_article])) {
            if($_SESSION["panier"][$id_article] > 1) {
                $_SESSION["panier"][$id_article] = intval($_SESSION["panier"][$id_article]) - 1;
            } else {
                unset($_SESSION["panier"][$id_article]);
            }
        }
    }
    header('location:../panier.php');
    die();
<?php

    //        STRUCTURE D'UN PANIER :
    //
    // n° d'article        nombre d'articles
    //     23          =>           2
    //     15          =>           1
    //     34          =>           4
    //     16          =>           3

    session_start();
    if(!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = array();
    }
    $id_article = $_GET["id_article"];
    if(isset($_SESSION["panier"][$id_article])) {
        $_SESSION["panier"][$id_article] = intval($_SESSION["panier"][$id_article]) + 1;
    } else {
        $_SESSION["panier"][$id_article] = 1;
    }
    // echo json_encode($_SESSION["panier"]);
    die();
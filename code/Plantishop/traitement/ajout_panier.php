<?php

    //        STRUCTURE D'UN PANIER :
    //
    // n° d'article        nombre d'articles
    //     23          =>           2
    //     15          =>           1
    //     34          =>           4
    //     16          =>           3

    session_start();
    if(isset($_SESSION["panier"])) {
        $num_article = $_POST["num_article"];
        if(isset($_SESSION["panier"][$num_article])) {
            $_SESSION["panier"][$num_article] = intval($_SESSION["panier"][$num_article]) + 1;
        } else {
            $_SESSION["panier"][$num_article] = 1;
        }
    } else {
        $_SESSION["panier"] = array();
    }
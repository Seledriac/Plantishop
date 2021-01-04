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
    if(isset($_GET['id_article'])) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");        
        $sql = "SELECT qte_stock FROM article WHERE id_article=? LIMIT 1;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('d', $_GET["id_article"]);
        $stmt->execute();
        $result = array_map("utf8_encode", $stmt->get_result()->fetch_assoc());
        if($result['qte_stock'] > 0) {            
            $id_article = $_GET["id_article"];            
            if(isset($_SESSION["panier"][$id_article])) {
                $_SESSION["panier"][$id_article] = intval($_SESSION["panier"][$id_article]) + 1;                
            } else {
                $_SESSION["panier"][$id_article] = 1;
            }            
        } else {
            echo json_encode($result);
        }
    }
    die();
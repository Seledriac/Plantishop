<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    session_start();
    if(!(isset($_GET["nb_articles"]))) {
        die();
    }
    $nb_articles = $_GET["nb_articles"];
    $nb_articles_plus_6 = strval(intval($nb_articles + 6));
    $query = "%%";
    $type = "%%";
    $prix_min = 0;
    $prix_max = 10000;
    if(isset($_GET["query"])) { 
        $query = "%".$_GET["query"]."%";
    }
    if(isset($_GET["tri-type"])) { 
        $type = "%".$_GET["tri-type"]."%";
    }
    if(isset($_GET["prix-min"])) {
        if(is_numeric($_GET["prix-min"])) {
            $prix_min = intval($_GET["prix-min"]);
        }
    }
    if(isset($_GET["prix-max"])) {
        if(is_numeric($_GET["prix-max"])) {
            $prix_max = intval($_GET["prix-max"]);
        }
    }
    if($prix_min > $prix_max) {
        $tmp = $prix_min;
        $prix_min = $prix_max;
        $prix_max = $prix_min;
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);    
    include '../config.php';
    $mysqli = new mysqli(constant('server') . ':' . constant('mysql_port'), constant('user_sql'), constant('pass_sql'), constant('dbname'));
    $mysqli->set_charset("latin1");
    $sql = "SELECT id_article, nom, prix, qte_stock FROM article WHERE nom LIKE ? AND type LIKE ? AND prix BETWEEN ? AND ? ORDER BY id_article ASC LIMIT $nb_articles,$nb_articles_plus_6";
    $stmt = $mysqli->prepare($sql);
    // $stmt->bind_param('ssdddd', $query, $type, $prix_min, $prix_max, $nb_articles, $nb_articles_plus_6);
    $stmt->bind_param('ssdd', $query, $type, $prix_min, $prix_max);
    $stmt->execute();
    $result = $stmt->get_result();
    $results = array();
    while($row = $result->fetch_assoc()) {        
        if($row['qte_stock'] > 0 || $_SESSION['type'] == 'admin') {
            $results[] = array_map("utf8_encode", $row);
        }
    }
    // FORMAT D'UN OBJET RENVOYÉ        
    // {
    //     {
    //         id_article : 1,
    //         nom : "Monstera",
    //         prix : 17.99,
    //     },
    //     .
    //     etc
    //     .
    //     .
    // }
    echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $mysqli->close();
    die();
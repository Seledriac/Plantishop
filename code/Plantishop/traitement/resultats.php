<?php
    $nb_articles = $_GET["nb_articles"];
    $nb_articles_plus_6 = strval(intval($nb_articles + 6));
    $query = "%%";
    $type = "%%";
    $prix_min = 0;
    $prix_max = 1000;
    if(isset($_GET["query"])) { 
        $query = "%".$_GET["query"]."%";
    }
    if(isset($_GET["tri-type"])) { 
        $type = "%".$_GET["tri-type"]."%";
    }
    if(isset($_GET["prix-min"])) {
        if(isset($_GET["prix-max"])) {
            if($_GET["prix-min"] < $_GET["prix-max"])
                $prix_max = intval($_GET["prix-min"]);
        } else {
            $prix_min = intval($_GET["prix-min"]);
        }
    }
    if(isset($_GET["prix-max"])) {
        if(isset($_GET["prix-min"])) {
            if($_GET["prix-max"] > $_GET["prix-min"])
                $prix_max = intval($_GET["prix-max"]);
        } else {
            $prix_max = intval($_GET["prix-max"]);
        }
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $sql = "SELECT id_article, nom, prix FROM article WHERE nom LIKE ? AND type LIKE ? AND prix BETWEEN ? AND ? LIMIT ?,?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssdddd', $query, $type, $prix_min, $prix_max, $nb_articles, $nb_articles_plus_6);
    $stmt->execute();
    $result = $stmt->get_result();
    $results = array();
    while($row = $result->fetch_assoc()) {
        $results[] = array_map("utf8_encode", $row);
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
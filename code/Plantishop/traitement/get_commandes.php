<?php
    session_start();
    if(!(isset($_SESSION["id_client"]))) {
        die();
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include '../config.php';
    $mysqli = new mysqli(constant('server') . ':' . constant('mysql_port'), constant('user_sql'), constant('pass_sql'), constant('dbname'));
    $mysqli->set_charset("latin1");
    $sql = "SELECT id_commande,date FROM commande WHERE id_client=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('d', $_SESSION["id_client"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $results = array();
    while($row = $result->fetch_assoc()) {
        $results[] = array_map("utf8_encode", $row);
    }
    // On renvoie les résultats sous forme d'objets JS
    // Les données sont de la forme :
    // {
    //     id_commande : 1054875643,
    //     date : "09/12/2020"
    // }
    echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $mysqli->close();
    die();
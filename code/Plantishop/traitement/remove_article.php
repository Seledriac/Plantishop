<?php
    session_start();
    if(isset($_SESSION["type"])) {
        if(!($_SESSION["type"] == "admin")) {
            header('location:../index.php');
            die();
        }
    } else {
        header('location:../index.php');
        die();
    }
    if(!(isset($_GET["id_article"]))) {
        header('location:../index.php');
        die();
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include '../config.php';
    $mysqli = new mysqli(constant('server') . ':' . constant('mysql_port'), constant('user_sql'), constant('pass_sql'), constant('dbname'));
    $mysqli->set_charset("latin1");
    $stmt = $mysqli -> prepare("SELECT * FROM ligne WHERE id_article = ?");
    $stmt->bind_param("d", $_GET['id_article']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        header('location:../article.php?id_article='.$_GET["id_article"]);
        die();
    }
    $sql = "DELETE FROM article WHERE id_article= ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('d', $_GET["id_article"]);
    $stmt->execute();
    unlink("../images/articles/article_".$_GET["id_article"].".jpg");
    if(isset($_SESSION["panier"])) { 
        if(isset($_SESSION["panier"][$_GET["id_article"]])) { 
            unset($_SESSION["panier"][$_GET["id_article"]]);
        }
    }
    header('location:../index.php');
    die();
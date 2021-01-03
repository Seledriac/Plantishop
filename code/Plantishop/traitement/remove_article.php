<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $sql = "DELETE FROM article WHERE id_article= ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('d', $_GET["id_article"]);
    $stmt->execute();
    header('location: ../index.php');
    die();
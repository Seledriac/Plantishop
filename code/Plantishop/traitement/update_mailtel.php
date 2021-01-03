<?php
    session_start();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $stmt = $mysqli->prepare("UPDATE utilisateur SET mail=?, tel=? WHERE id_client=?;");
    $stmt->bind_param("ssd", $_POST["mail"], $_POST["tel"], $_SESSION["id_client"]);
    $stmt->execute();
    $_SESSION["mail"] = $_POST["mail"];
    $_SESSION["tel"] = $_POST["tel"];
    header('location:../profil.php');
    die();
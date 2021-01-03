<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $sql = "INSERT INTO utilisateur(type, username, pass, mail, tel) VALUES('client', ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    if($_POST["user_password"] != $_POST["user_password_confirmation"]) {
        header("location:./page_inscription.php");
    }
    $stmt->bind_param('ssss', $_POST["user_name"], $_POST["user_password"], $_POST["user_email"], $_POST["phone"]);
    $stmt->execute();
    if(isset($_POST["id_page"])) { // Redirection vers la page de connexion
        header('location:../profil.php?id_page='.$_POST["id_page"]);
    } else {
        header('location:../profil.php');
    }
    die();    
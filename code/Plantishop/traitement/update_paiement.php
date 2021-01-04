<?php
    session_start();
    if(!(isset($_SESSION["id_client"]))) {
        header('location:../index.php');
        die();
    }
    if(!(isset($_POST["num_cb"]) && isset($_POST["nom_cb"]) && isset($_POST["num_cvv"]))) {
        header('location:../index.php');
        die();
    }
    if(!(is_numeric($_POST['num_cb']) && is_string($_POST['nom_cb']) && is_numeric($_POST['num_cvv']))) {
        header('location:../index.php');
        die();
    }
    if(strlen($_POST['nom_cb']) > 100 || strlen($_POST['num_cvv']) != 3) {
        header('location:../index.php');
        die();
    }
    function is_valid_luhn($number) {
        settype($number, 'string');
        $sumTable = array(
            array(0,1,2,3,4,5,6,7,8,9),
            array(0,2,4,6,8,1,3,5,7,9));
        $sum = 0;
        $flip = 0;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $sum += $sumTable[$flip++ & 0x1][$number[$i]];
        }
        return $sum % 10 === 0;
    }
    if(!is_valid_luhn($_POST['num_cb'])) {
        header('location:../index.php');
        die();
    }
    echo var_dump($_POST["num_cb"]);
    echo var_dump($_POST["nom_cb"]);
    echo var_dump($_POST["num_cvv"]);
    echo var_dump($_SESSION["id_client"]);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $stmt = $mysqli->prepare("UPDATE utilisateur SET num_cb=?, nom_cb=?, num_cvv=? WHERE id_client=?;");
    $stmt->bind_param("sssd", $_POST["num_cb"], $_POST["nom_cb"], $_POST["num_cvv"], $_SESSION["id_client"]);
    $stmt->execute();
    $_SESSION["num_cb"] = $_POST["num_cb"];
    $_SESSION["nom_cb"] = $_POST["nom_cb"];
    $_SESSION["num_cvv"] = $_POST["num_cvv"];
    header('location:../profil.php');
    die();
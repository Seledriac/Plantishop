<?php
    $sql = "UPDATE utilisateur SET email=".$_POST["email"].", pass=".$_POST["pass"]." WHERE id_client=".$_POST["id_client"];
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = 'pass';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$conn ){
        die('Erreur de connexion : ' . mysqli_error());
    }
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    die();
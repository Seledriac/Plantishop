<?php
    $sql = "
    UPDATE article 
    SET type=". $_POST["type"] .
    ", nom=".$_POST["nom"] .
    ", prix=".$_POST["prix"] .
    ", description=" . $_POST["description"]." 
    WHERE id_article=" . $_POST["id_article"];
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = 'pass';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$conn ){
        die('Erreur de connexion : ' . mysqli_error());
    }
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:index.php');
<?php
    $sql = "
    INSERT INTO article(type, nom, prix, description)
    VALUES (". $_POST["type"] .",". $_POST["nom"] .",". $_POST["prix"] .",". $_POST["description"];
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
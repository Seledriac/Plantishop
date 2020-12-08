<?php
    $_GET["id_page"] = 3;
    include '/header.php';    
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = 'pass';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$conn ){
        die('Erreur de connexion : ' . mysqli_error());
    }
    $lignes = array();
    if(isset($_SESSION["panier"])) {
        foreach($_SESSION["panier"] as $id_article => $nb_articles) {
            $sql = $mysqli -> prepare('SELECT nom, prix FROM article WHERE id_article = ?');
            $sql->bind_param("i", $id_article);
            $sql->execute();
            $result = $sql->get_result();
            $lignes[$id_article] = $result->fetch_assoc();
            $lignes[$id_article]["quantite"] =  $nb_articles;
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panier</title>
    </head>
    <body>
        <form action="commander.php">
            
        </form>
    </body>
</html>
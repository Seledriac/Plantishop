<?php
    if(isset($_GET["id_article"])) { // L'id d'article est passé en paramètre get des liens d'articles
        $dbhost = 'localhost:3306';
        $dbuser = 'root';
        $dbpass = 'pass';
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
        if(!$conn ){
            die('Erreur de connexion : ' . mysqli_error());
        }
        $sql = $mysqli -> prepare('SELECT * FROM article WHERE id_article = ?');
        $sql->bind_param("i", $_GET["id_article"]); 
        $sql->execute();   
        $result = $sql->get_result();
        $getData = $result->fetch_assoc(); 
        // Les données sont de la forme :
        // [
        //     id_article => 2,
        //     type => "plante",
        //     nom => "Monstera",
        //     prix => 17.99,
        //     description => "Texte.................Fin Texte."
        //]
        //
        //

        mysqli_close($conn);
        die();
    } else {
        header('location:index.php');
    }
    $_GET["id_page"] = 2;
    include '/header.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $getData["nom"] ?></title>
    </head>
    <body>
        <script>
            // Cliquer sur le bouton "Ajouter au panier" envoie une requête AJAX à /traitement/ajout_panier.php
        </script>
    </body>
</html>
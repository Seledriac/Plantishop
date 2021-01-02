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
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<title><?php echo $getData["nom"] ?></title>-->
        <link rel="stylesheet" href="css/article.css">
    </head>
    <body>
        <script>
            // Cliquer sur le bouton "Ajouter au panier" envoie une requête AJAX à /traitement/ajout_panier.php
        </script>

        <div>
            <div>
                <h1>Titre Plante</h1>
                <h2>Catégorie Plante</h2>
                <img src="edit.png" width="70px" height="50px" id="edit_button">
                <img src="trash.png" width="70px" height="50px" id="trash_button">              
            </div>

            <div>

                <div>
                    <!-- image de la plante-->
                    <img src="5.jpg" width="500px" height="500px">
                </div>

                <div>
                    <div>
                        <p>Magnifique plante d'intérieure, le monstera est l'une des plantes
                            les plus vendues mais aussi l'une des plus résistantes ce qui la rend
                            facile à cultiver.
                            Feuillage unique et grand pouvoir décoratif, elle fera votre bonheur.
                        </p>
                        <!-- Description article -->
                    </div>

                    <div>
                        <p>17,99 €</p>
                        <!-- Prix -->
                    </div>

                    <div>
                        <a href="">Ajouter au panier</a>
                        <!-- Ajouter au panier -->
                    </div>
                </div>

            </div>
        
        </div>
    </body>
</html>
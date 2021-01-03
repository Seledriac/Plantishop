<?php
    session_start();
    include './header.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="css/page_connexion.css">        
        <title>Page de connexion</title>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">
            <form action="./traitement/connexion.php" method="POST">
                <h1>Page de connexion</h1>

                <div id="Pseudonyme">
                    <label for="name">Nom d'utilisateur</label>   
                </div>

                <div id="Pseudonyme2">
                    <input type="text" id="name" name="user_name">
                </div>

                <div id="MotDePasse">
                    <label for="password">Mot de passe</label>
                </div>

                <div id="MotDePasse2">
                    <input type="password" id="password" name="user_password">
                </div>

                <?php if(isset($_GET["id_page"])) { 
                    $id_page = $_GET["id_page"]; ?>                
                    <input type="hidden" name="id_page" value="<?php echo $_GET["id_page"]; ?>">
                <?php } ?>

                <div id="No_account">
                <a href="./page_inscription.php<?php if(isset($_GET["id_page"])) {echo "?id_page=".$_GET["id_page"];} ?>" style="text-decoration: none; color: #5cadff;">Je n'ai pas de compte</a>
                </div>

                <div id="connexion_button">
                    <button type="submit"> Connexion </button>
                </div>
            </form>
        </div>
    </body>
</html>
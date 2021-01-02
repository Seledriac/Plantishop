<?php
    include '/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de connexion</title>
    </head>
    <body>
        <form action="/traitement/connexion.php">
            <?php if(isset($_GET["id_page"])) { 
                $id_page = $_GET["id_page"]; ?>
                <input type="hidden" name="id_page" value="<?php echo $_GET["id_page"]; ?>">
            <?php } ?>

            <?php if(isset($_GET["id_article"])) {
                 $id_page = $_GET["id_article"];?>
                <input type="hidden" name="id_article" value="<?php echo $_GET["id_article"]; ?>">
            <?php } ?>
            <a href="page_inscription.php?<?php echo $parameters; ?>">Je n'ai pas de compte</a>
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

            <div id="No_account">
            <a href="" style="text-decoration: none; color: #5cadff;">Je n'ai pas de compte</a>
            </div>

            <div id="connexion_button">
                <button type="submit"> Connexion </button>
            </div>
        </form>
    </body>
</html>
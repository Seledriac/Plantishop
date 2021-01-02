<?php
    include './header.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="css/page_connexion.css">        
        <title>Page de connexion</title>
    </head>
    <body>
        <form action="./traitement/connexion.php">
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

            <?php if(isset($_GET["id_article"])) {
                $id_page = $_GET["id_article"];?>
                <input type="hidden" name="id_article" value="<?php echo $_GET["id_article"]; ?>">
            <?php } ?>

            <div id="No_account">
            <a href="./page_inscription.php?<?php echo $parameters; ?>" style="text-decoration: none; color: #5cadff;">Je n'ai pas de compte</a>
            </div>

            <div id="connexion_button">
                <button type="submit"> Connexion </button>
            </div>
        </form>
    </body>
</html>
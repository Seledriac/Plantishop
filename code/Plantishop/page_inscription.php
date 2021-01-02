<?php
    include '/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page d'inscription</title>
    </head>
    <body>
        <form action="/traitement/inscription.php">
            <?php if(isset($_GET["id_page"])) { $id_page = $_GET["id_page"]; ?>
                <input type="hidden" name="id_page" value="<?php echo $_GET["id_page"]; ?>">
            <?php } ?>
            <?php if(isset($_GET["id_article"])) { $id_page = $_GET["id_article"];?>
                <input type="hidden" name="id_article" value="<?php echo $_GET["id_article"]; ?>">
            <?php } ?>
            <h1>Page d'inscription</h1>

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

            <div id="Confirmer_MotDePasse">
                <label for="password">Confirmer mot de passe</label>
            </div>

            <div id="Confirmer_MotDePasse2">
                <input type="password" id="confirm_password" name="user_password_confirmation">
            </div>

            <div id="Email">
                <label for="password">Adresse mail</label>
            </div>

            <div id="Email2">
                <input type="email" id="mail" name="user_email">
            </div>

            <div id="Phone">
                <label for="password">Numéro de téléphone</label>
            </div>

            <div id="Phone2">
                <input type="tel" id="phone" name="phone"
                pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"
                required>
            </div>

            <div id="inscription_button">
                <button type="submit"> Inscription </button>
            </div>
        </form>
    </body>
</html>
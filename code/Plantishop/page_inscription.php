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
        </form>
    </body>
</html>
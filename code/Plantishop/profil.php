<?php
    include '/header.php';
    session_start();
    if(!(isset($_SESSION["id_client"]))) {
        header('location:page_connexion.php?'.$parameters);
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de profil</title>
    </head>
    <body>

    </body>
</html>
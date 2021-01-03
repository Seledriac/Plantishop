<?php
    session_start();
    $str = "location:page_connexion.php";
    if(!(isset($_SESSION["id_client"]))) {
        $str.='?id_page='.$_GET["id_page"];        
        header($str);
    }
    $GET_["id_page"] = 5;
    include "./header.php";
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de profil - <?php echo $_SESSION["username"] ?></title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/profil.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
        <script src="./librairies/jquery-3.5.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>

    </body>
</html>
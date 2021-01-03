<?php
    $_GET["id_page"] = 2;
    include '/header.php';
    session_start();
    if(!(isset($_SESSION["id_client"]))) {
        header('location:page_connexion.php?'.$parameters);
    }
    $sql = "SELECT * FROM utilisateur WHERE id_client=\'". $_SESSION["id_client"]."\'";
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = 'pass';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$conn ){
        die('Erreur de connexion : ' . mysqli_error());
    }
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Commande</title>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <form action="commande.php" method="POST">
            <input type="text" name="adresse_facturation" value="<?php if(isset($row["adresse_facturation"])) $row["adresse_facturation"]; ?>">
            <input type="text" name="adresse_livraison" value="<?php if(isset($row["adresse_livraison"])) $row["adresse_livraison"]; ?>">
            <input type="text" name="num_carte" value="<?php if(isset($row["num_carte"])) $row["num_carte"]; ?>">
            <input type="text" name="adresse_facturation" value="<?php if(isset($row["nom_paiement"])) $row["nom_paiement"]; ?>">
            <input type="text" name="num_cvv" value="<?php if(isset($row["num_cvv"])) $row["num_cvv"]; ?>">
            <input type="submit" value="Confirmer la commande">
        </form>
    </body>
</html>
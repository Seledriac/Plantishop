<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    session_start();
    if(isset($_GET["id_commande"]) && isset($_SESSION["id_client"])) {
        $_GET["id_page"] = 3;
        include './header.php';
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
        $stmt = $mysqli -> prepare("SELECT * FROM commande WHERE id_commande=? AND id_client=? LIMIT 1");
        $stmt->bind_param("dd", $_GET["id_commande"], $_SESSION["id_client"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if(!($result->num_rows == 1)) {
            header('location:./index.php');
            die();
        }
        $stmt = $mysqli -> prepare("SELECT * FROM ligne INNER JOIN article ON ligne.id_article=article.id_article WHERE id_commande=?");
        $stmt->bind_param("d", $_GET["id_commande"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $encoded_result = array_map("utf8_encode", $result->fetch_assoc());
        if($result->num_rows > 1) {
            $lignes = $encoded_result;
        } else {
            $lignes = [$encoded_result];
        }
        $mysqli->close();
    } else {
        header('location:./index.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panier</title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/panier.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
        <script src="./librairies/jquery-3.5.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">
            <form action="./profil.php">
                <div id="panier">
                    <table>
                        <tr id="entetes">
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                        </tr>
                        <?php foreach($lignes as $ligne) {?>
                            <tr class="ligne">
                                <td class="nom"><?php echo $ligne["nom"] ?></td>
                                <td class="quantite"><?php echo $ligne["quantite"] ?></td>
                                <td class="prix"><?php echo $ligne["prix"] ?>€</td>
                            </tr>
                        <?php }?>
                    </table>
                </div>
                <div id="div-commander">
                    <div id="somme">Total : <span></span></div>
                    <div id="btn-commander"><button type="submit">Retour aux commandes</button></div>
                </div>
                <script>
                    var lignes = document.querySelectorAll(".ligne");
                    var somme = 0;
                    lignes.forEach((ligne) => {
                        somme += parseFloat(ligne.querySelector(".prix").innerText) * parseFloat(ligne.querySelector(".quantite").innerText);
                    });
                    document.querySelector("#somme span").innerText = somme.toFixed(2) + "€";
                </script>
            </form>
        </div>        
    </body>
</html>
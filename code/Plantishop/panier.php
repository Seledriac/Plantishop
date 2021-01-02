<?php
    $_GET["id_page"] = 3;
    include './header.php';
    session_start();
    if(isset($_SESSION["panier"])) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
        $lignes = array();
        foreach($_SESSION["panier"] as $id_article => $nb_articles) {
            $stmt = $mysqli -> prepare("SELECT nom, prix FROM article WHERE id_article = ?");
            $stmt->bind_param("d", $id_article);
            $stmt->execute();
            $result = $stmt->get_result();
            $lignes[$id_article] = $result->fetch_assoc();
            $lignes[$id_article]["quantite"] =  $nb_articles;
        }        
        $mysqli->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panier</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/panier.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <form action="./commander.php">
                <div id="panier">
                    <table>
                        <tr id="entetes">
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                        </tr>
                        <?php if(isset($_SESSION["panier"])) { foreach($lignes as $ligne) {?>
                            <tr class="ligne">
                                <td class="nom"><?php echo $ligne["nom"] ?></td>
                                <td class="quantite"><?php echo $ligne["quantite"] ?></td>
                                <td class="prix"><?php echo $ligne["prix"] ?>€</td>
                            </tr>
                        <?php } }?>
                    </table>
                </div>
                <div id="div-commander">
                    <div id="somme">Total : <span></span></div>
                    <form action="./commander.php"><div id="btn-commander"><button type="submit">Commander</button></div></form>
                </div>
                <script>
                    var lignes = document.querySelectorAll(".ligne");
                    var somme = 0;
                    lignes.forEach((ligne) => {
                        somme += parseFloat(ligne.querySelector(".prix").innerText) * parseFloat(ligne.querySelector(".quantite").innerText);
                    });
                    document.querySelector("#somme span").innerText = somme + "€";
                </script>
            </form>
        </div>        
    </body>
</html>
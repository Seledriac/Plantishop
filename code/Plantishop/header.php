<?php
    // Récupérer les paramètres de pages passés en get permet de les transférer
    // à la page de connexion lorsque le bouton profil est cliqué
    if(isset($_GET["id_page"])) {
        $parameters = "id_page=".$_GET["id_page"];
    }
    if(isset($_GET["id_article"])) {
        $parameters = $parameters."&id_article=".$_GET["id_article"];
    }
?>

<html>
    <a href="/index.php?reset=yes">Image du logo Plantishop</a>
    <a href="/panier.php">Image du panier</a>
    <a href="/profil.php?<?php echo $parameters; ?>">Image de l'icone de profil</a>
</html>
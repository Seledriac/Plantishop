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
    <div id="header">
        <section id="titre">
            <a href="/index.php?reset=yes">Plantishop</a>
        </section>
        <section id="section-tri">
            <div id="search-bar">
                <input type="text" name="query">
                <button><i class="fa fa-search"></i></button>
            </div>
            <div id="tris">
                <div id="tri-marque">
                    <label for="tri-marque">Marque</label>
                    <input type="text" name="tri-marque">
                </div>
                <div id="tri-prix">
                    <label for="prix-min">Min</label>
                    <input type="number" name="prix-min">
                    <label for="prix-max">Max</label>
                    <input type="number" name="prix-max">
                </div>
                <div id="bouton-trier">
                    <button>Trier</button>
                </div>
            </div>
        </section>
        <section id="section-profil">
            <div id="section-profil-haut">
                <a href="./panier.php" id="icone-panier"><img src="./images/icone_panier.jpg" alt=""></a>
                <a href="./profil.php?<?php echo $parameters; ?>" id="icone-profil"><img src="./images/icone_profil.png" alt=""></a>
            </div>
            <div id="section-profil-bas">
                <?php if(isset($_SESSION["id_client"])) {if($_SESSION["type"] == "admin") {?> 
                    <a href="./creation_article.php"><i class="fa fa-plus-circle"></i></a>
                <?php } }?>
            </div>
        </section>
    </div>
    <script>

    </script>
</html>
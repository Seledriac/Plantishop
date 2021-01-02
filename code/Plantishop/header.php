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
            <a href="./index.php">Plantishop</a>
        </section>
        <form action="./index.php?" method="GET">
            <section id="section-tri">            
                <div id="search-bar">
                    <input type="text" name="query">
                    <button type="submit"><i class="fa fa-search"></i></button>                
                </div>
                <div id="tris">
                    <div id="tri-type">
                        <label for="tri-type">Type</label>
                        <input type="text" name="tri-type">
                    </div>
                    <div id="tri-prix">
                        <label for="prix-min">Min</label>
                        <input type="number" name="prix-min" default="0" min="0" max="999" value="0">
                        <label for="prix-max">Max</label>
                        <input type="number" name="prix-max" default="50" min="1" max="1000" value="50">
                    </div>
                    <div id="bouton-trier">
                        <button type="submit">Trier</button>
                    </div>
                </div>
            </section>
        </form>
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
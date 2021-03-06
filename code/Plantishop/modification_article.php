<?php
    session_start();
    if(isset($_SESSION["type"])) {
        if(!$_SESSION["type"] == "administrateur") {
            header('location:./index.php');
            die();
        }
    } else {
        header('location:./index.php');
        die();
    }
    if(isset($_GET["id_article"])) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        include './config.php';
        $mysqli = new mysqli(constant('server') . ':' . constant('mysql_port'), constant('user_sql'), constant('pass_sql'), constant('dbname'));
        $mysqli->set_charset("latin1");
        $sql = "SELECT * FROM article WHERE id_article=? LIMIT 1";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('d', $_GET["id_article"]);
        $stmt->execute();
        $result = array_map("utf8_encode", $stmt->get_result()->fetch_assoc());
        if(count($result) < 1) {
            header('location:./index.php');
            die();
        }
    } else {
        header('location:./index.php');
        die();
    }
    include './header.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de modification d'article</title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/creation_article.css">        
        <script src="./librairies/jquery-3.5.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">
            <form action="./traitement/modif_article.php" method="POST" enctype="multipart/form-data">
            <h1>Page de modification d'article</h1>

            <div id="Nom">
                <label for="nom">Nom</label>
                <input type="text" id="name" name="nom" value="<?php echo $result["nom"]; ?>" required>   
            </div>

            <div id="Prix">
                <label for="prix">Prix</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" name="prix" value="<?php echo $result["prix"]; ?>" required>
            </div>

            <div id="Description">
                <label for="description">Description</label>
                <textarea id="msg" name="description" cols="80" rows="10" required><?php echo $result["description"]; ?></textarea>
            </div>

            <div id="Categorie">
                <label for="type">Type</label>
                <input type="text" id="categorie-select" name="type" value="<?php echo $result["type"]; ?>" required>
            </div>

            <div id="Cover">
                <label for="Image">Image (jpg)</label>
                <input type="file"
                    id="article_image" name="image"
                    accept="image/jpeg">
            </div>

            <div id="qte_stock">
                <label for="type">Quantité en stock</label>
                <input type="number" id="qte_stock" name="qte_stock" value="<?php echo $result["qte_stock"]; ?>" min="0" required>
            </div>

            <?php if(isset($_GET["id_page"])) { 
                $id_page = $_GET["id_page"]; ?>                
                <input type="hidden" name="id_page" value="<?php echo $_GET["id_page"]; ?>">
            <?php } ?>

            <?php if(isset($_GET["id_article"])) { 
                $id_page = $_GET["id_article"]; ?>                
                <input type="hidden" name="id_article" value="<?php echo $_GET["id_article"]; ?>">
            <?php } ?>

            <div id="creation_button">
                <button type="submit"> Modifier </button>
            </div>
            </form>
        </div>
        <script>
            document.querySelector("#creation_button button").addEventListener('click', function(e) {
                var nom = document.querySelector("input[name=nom]");
                var prix = document.querySelector("input[name=prix]");
                var description = document.querySelector("input[name=description]");
                var type = document.querySelector("input[name=type]");
                nom.style.backgroundColor = 'white';
                prix.style.backgroundColor = 'white';
                description.style.backgroundColor = 'white';
                type.style.backgroundColor = 'white';                    
                if(isNaN(prix)) {
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(type.length > 50){
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(nom.length > 50) {
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(prix.length > 10 || prix.value < 0) {
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(description.length > 500) {
                    prix.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
                if(qte_stock.length > 10 || qte_stock.value < 0) {
                    qte_stock.style.backgroundColor = '#ff0033';
                    e.preventDefault();
                    return;
                }
            });
        </script>
    </body>
</html>
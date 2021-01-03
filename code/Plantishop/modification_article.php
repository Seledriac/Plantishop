<?php
    session_start();
    if(isset($_SESSION["type"])) {
        if(!$_SESSION["type"] == "administrateur") {
            header('location:index.php');
            die();
        }
    } else {
        header('location:index.php');
        die();
    }
    if(isset($_GET["id_article"])) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
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
                <input type="text" id="name" name="nom" value="<?php echo $result["nom"]; ?>">   
            </div>

            <div id="Prix">
                <label for="prix">Prix</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" name="prix" value="<?php echo $result["prix"]; ?>">
            </div>

            <div id="Description">
                <label for="description">Description</label>
                <textarea id="msg" name="description" cols="80" rows="10"><?php echo $result["description"]; ?></textarea>
            </div>

            <div id="Categorie">
                <label for="type">Type</label>
                <input type="text" id="categorie-select" name="type" value="<?php echo $result["type"]; ?>">
            </div>

            <div id="Cover">
                <label for="Image">Image (jpg)</label>
                <input type="file"
                    id="article_image" name="image"
                    accept="image/png, image/jpeg">
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
    </body>
</html>
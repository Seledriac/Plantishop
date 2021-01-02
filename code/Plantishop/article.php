<?php
    if(isset($_GET["id_article"])) { // L'id d'article est passé en paramètre get des liens d'articles  
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
        $sql = "SELECT * FROM article WHERE id_article = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('d', $_GET["id_article"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $getData = array_map("utf8_encode", $result->fetch_assoc());
        // Les données sont de la forme :
        // [
        //     id_article => 1,
        //     type => "Plante",
        //     nom => "Monstera",
        //     prix => 17.99,
        //     description => "Texte.................Fin Texte."
        //]
        $mysqli->close();
    } else {
        header('location:index.php');
    }
    $_GET["id_page"] = 2;
    include './header.php';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $getData["nom"]; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/header.css">        
        <link rel="stylesheet" href="./css/article.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">
            <header>
                <div id="titre">
                    <div>
                        <h1><?php echo $getData["nom"]; ?></h1>
                        <p><?php echo $getData["type"]; ?></p>
                    </div>                    
                </div>
                <div id="edit">
                    <?php if(isset($_SESSION["id_client"])) {if($_SESSION["type"] == "admin") {?> 
                        <a href="./modification_article.php?id_article=<?php echo $_GET["id_article"]; ?>"><i class="fa fa-edit"></i></a>
                        <a href="./traitement/remove_article.php?id_article=<?php echo $_GET["id_article"]; ?>"><i class="fa fa-trash"></i></a>
                    <?php } }?>
                </div>            
            </header>
            <main>
                <div id="image-article">
                    <img src="./images/articles/article_<?php echo $_GET["id_article"] ?>.jpg" alt="<?php echo $getData["nom"]; ?>">
                </div>
                <div id="article">
                    <section id="infos-article">
                        <p><?php echo $getData["description"]; ?></p>
                    </section>
                    <div id="prix-article">
                        <p><?php echo str_replace(".", ",", $getData["prix"]); ?>€</p>
                    </div>
                    <div id="btn-ajouter">
                        <button type="submit">Ajouter au panier</button>
                    </div>                
                </div>
            </main>
        </div>        
        <script>
            getParameters = () => {             
                address = window.location.search;
                parameterList = new URLSearchParams(address);
                let map = new Map();            
                parameterList.forEach((value, key) => { 
                    map.set(key, value);
                })
                return map;
            }
            window.map = getParameters();
            $(document).ready(function() {
                $("#btn-ajouter").click(function(){
                    $.ajax({
                        type: "GET",
                        url: "./traitement/ajout_panier.php",
                        data: {"id_article": window.map.get("id_article")},
                        dataType: 'json',
                        success: function(panier) {
                            //console.log(panier)}
                        },
                        error: function(xhr, ajaxOptions, thrownError) { 
                            console.log(xhr.responseText);
                        }
                    });        
                });
            });            
        </script>
    </body>
</html>
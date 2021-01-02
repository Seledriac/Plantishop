<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    $_GET["id_page"] = 1;
    include './header.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plantishop - Tout pour le jardin à prix malin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/accueil.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="produits"></div>
        <script>
            window.nb_produits = 0;
            function loadProduits() {
                $.ajax({
                    type: "GET", 
                    url: "./traitement/resultats.php",
                    data: {'nb_produits': nb_produits},
                    dataType: 'json',
                    success: function(produits) {
                        var conteneur = document.querySelector("#produits");
                        for (var i = 0; i < produits.length; i++) {
                            var article = document.createElement("a");
                            article.href = "./article.php?id_article=" + produits[i].id_article;
                            article.style.backgroundImage = "url('./images/articles/article_" + produits[i].id_article + ".jpg')";
                            var num_article = produits[i].id_article - 1 % 6 + 1;
                            article.classList.add("article-grid" + num_article, "article");
                            var article_details = document.createElement("div");
                            article_details.classList.add("article-details");
                            var article_nom = document.createElement("p");
                            article_nom.classList.add("article-nom");
                            var article_prix = document.createElement("p");
                            article_prix.classList.add("article-prix");
                            article_nom.innerHTML = produits[i].nom;
                            article_prix.innerHTML = produits[i].prix + "€";
                            article_details.appendChild(article_nom);
                            article_details.appendChild(article_prix);
                            article.appendChild(article_details);
                            conteneur.appendChild(article);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) { alert(xhr.responseText); }
                });
                // var xhr = new XMLHttpRequest();
                // xhr.addEventListener('readystatechange', function() {
                //     if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // var main = document.querySelector("main");
                        // console.log(xhr.responseText);
                        // var htmlObject = document.createElement('div');
                        // htmlObject.innerHTML = xhr.responseText;
                        // var logs = htmlObject.querySelectorAll(".request");
                        // logs.forEach((log) => {
                        //     main.appendChild(log); 
                        //     log.classList.add("animate__animated", "animate__fadeIn");
                        //     log.style.setProperty('--animate-duration', '0.5s');
                        // });
                        // htmlObject.remove();
                        // window.nb_produits += 6;
                        // window.onscroll = yHandler; // reactivate scroll event
                //     }
                // });
                // xhr.open('GET', './traitement/resultats.php');
                // var nb_produits = encodeURIComponent(window.nb_produits);
                // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                // xhr.send('nb_produits=' + nb_produits);
            }
            // function yHandler(){ // scroll event       
            //     if(this.scrollHeight - (this.scrollTop + 1) <= this.clientHeight){
            //         loadProduits();
            //         this.onscroll = undefined; // desactivate scrollevent (to ensure it is executed only once)
            //     }
            // }
            // function yHandler(){
            //     var wrap = document.querySelector("#produits");
            //     var contentHeight = wrap.offsetHeight;
            //     var yOffset = window.pageYOffset; 
            //     var y = yOffset + window.innerHeight;
            //     if(y >= contentHeight){
            //         window.onscroll = undefined;
            //         loadProduits();
            //     }
            // }
            // window.onscroll = yHandler;
            loadProduits();
            // Requête AJAX qui demande les articles à /traitement/resultats.php
            // Le résultat est utilisé pour faire les liens vers les articles
        </script>
    </body>
</html>
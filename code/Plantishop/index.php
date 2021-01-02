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
        <script>
            getParameters = () => {             
                address = window.location.search 
                parameterList = new URLSearchParams(address) 
                let map = new Map()             
                parameterList.forEach((value, key) => { 
                    map.set(key, value) 
                })
                return map
            }
            map = getParameters();
            window.params = {};
            map.forEach((value, key) => {  
                window.params[key] = value  
            }); 
            window.params.nb_articles = 0;
            function loadArticles() {
                $.ajax({
                    type: "GET", 
                    url: "./traitement/resultats.php",
                    data: window.params,
                    dataType: 'json',
                    success: function(articles) {               
                        var conteneur = document.createElement("div");
                        conteneur.classList.add("articles");
                        for (var i = 0; i < articles.length; i++) {
                            var article = document.createElement("a");
                            article.href = "./article.php?id_article=" + articles[i].id_article;
                            article.style.backgroundImage = "url('./images/articles/article_" + articles[i].id_article + ".jpg')";
                            var num_article = articles[i].id_article - 1 % 6 + 1;
                            article.classList.add("article-grid" + num_article, "article");
                            var article_details = document.createElement("div");
                            article_details.classList.add("article-details");
                            var article_nom = document.createElement("p");
                            article_nom.classList.add("article-nom");
                            var article_prix = document.createElement("p");
                            article_prix.classList.add("article-prix");
                            article_nom.innerHTML = articles[i].nom;
                            article_prix.innerHTML = (articles[i].prix + "€").replace(".", ",");
                            article_details.appendChild(article_nom);
                            article_details.appendChild(article_prix);
                            article.appendChild(article_details);
                            conteneur.appendChild(article);
                            document.querySelector("body").appendChild(conteneur);
                        }
                        window.params.nb_articles += articles.length;
                    },
                    error: function(xhr, ajaxOptions, thrownError) { 
                        console.log(xhr.responseText);
                    }
                });
            }
            $(document).ready(function(){
                $(window).scroll(function(){
                    var position = parseInt(window.scrollY);
                    var bottom = parseInt($(document).height() - window.innerHeight);
                    if(position >= bottom - 1){
                        loadArticles();
                    }
                });
            });
            loadArticles();
            // Requête AJAX qui demande les articles à /traitement/resultats.php
            // Le résultat est utilisé pour faire les liens vers les articles
        </script>
    </body>
</html>
<?php
    $_GET["id_page"] = 1;
    session_start();
    include './header.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plantishop - Tout pour le jardin à prix malin</title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/accueil.css">
        <script src="./librairies/jquery-3.5.1.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
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
            map = getParameters();
            window.params = {};
            map.forEach((value, key) => {  
                window.params[key] = value; 
            }); 
            window.params.nb_articles = 0;
            function loadArticles() {
                var query = document.querySelector("input[name=query]");
                var tri_type = document.querySelector("input[name=tri-type]");
                var prix_min = document.querySelector("input[name=prix-min]");
                var prix_max = document.querySelector("input[name=prix-max]");                
                if(isNaN(prix_min.value) || isNaN(prix_max.value) || query.value.length > 100 || tri_type.value.length > 100) {
                    e.preventDefault();
                    return;
                }
                if(prix_min.value > prix_max.value) {
                    e.preventDefault();
                    return;
                }
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
        </script>
    </body>
</html>

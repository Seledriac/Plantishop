<?php
    session_start();
    include './header.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page d'inscription</title>
        <link href="./librairies/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/page_inscription.css">
        <link rel="icon" type="image/x-icon" href="./favicon.ico?">
    </head>
    <body>
        <div id="wrapper">
            <form action="./traitement/inscription.php" method="POST">
                <h1>Page d'inscription</h1>

                <div id="Pseudonyme">
                    <label for="name">Nom d'utilisateur</label>   
                </div>

                <div id="Pseudonyme2">
                    <input type="text" id="name" name="user_name" required>
                </div>

                <div id="MotDePasse">
                    <label for="password">Mot de passe</label>
                </div>

                <div id="MotDePasse2">
                    <input type="password" id="password" name="user_password" required>
                </div>

                <div id="Confirmer_MotDePasse">
                    <label for="password">Confirmer mot de passe</label>
                </div>

                <div id="Confirmer_MotDePasse2">
                    <input type="password" id="confirm_password" name="user_password_confirmation" required>
                </div>

                <div id="Email">
                    <label for="password">Adresse mail</label>
                </div>

                <div id="Email2">
                    <input type="email" id="mail" name="user_email" required>
                </div>

                <div id="Phone">
                    <label for="password">Numéro de téléphone</label>
                </div>

                <div id="Phone2">
                    <input type="text" id="phone" name="phone" required>
                </div>

                <?php if(isset($_GET["id_page"])) { 
                    $id_page = $_GET["id_page"]; ?>                
                    <input type="hidden" name="id_page" value="<?php echo $_GET["id_page"]; ?>">
                <?php } ?>

                <div id="inscription_button">
                    <button type="submit"> Inscription </button>
                </div>        
            </form>
        </div>
        <script>
            document.querySelector("#inscription_button button").addEventListener('click', function(e) {
                var user_name = document.querySelector("input[name=user_name]");
                var user_password = document.querySelector("input[name=user_password]");
                var user_password_confirmation = document.querySelector("input[name=user_password_confirmation]");
                var mail = document.querySelector("input[name=user_email]");
                var phone = document.querySelector("input[name=phone]");
                user_name.style.backgroundColor = 'white';
                user_password.style.backgroundColor = 'white';
                user_password_confirmation.style.backgroundColor = 'white';
                mail.style.backgroundColor = 'white';
                phone.style.backgroundColor = 'white';
                var str = phone.value;
                var newStr = str.replace(/-/g, "");
                var newStr2 = newStr.replace(/\s/g, '');
                phone.value = newStr2;
                if(user_password.value != user_password_confirmation.value) {
                    user_password.style.backgroundColor = 'red';
                    user_password_confirmation.style.backgroundColor = 'red';
                    e.preventDefault();
                }                
                if(user_name.value.length > 50) {
                    user_name.style.backgroundColor = 'red';
                    e.preventDefault();
                }
                if(user_password.value.length > 50) {
                    user_password.style.backgroundColor = 'red';
                    e.preventDefault();
                }          
                var regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!regEx.test(mail.value) || mail.value.length > 100) {
                    console.log("hello");
                    mail.style.backgroundColor = 'red';
                    e.preventDefault();
                    return;
                }
                var regEx2 = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
                if(!regEx2.test(phone.value) || phone.value.length > 100) {
                    console.log("hella");
                    phone.style.backgroundColor = 'red';
                    e.preventDefault();
                    return;
                }
            });
        </script>
    </body>
</html>
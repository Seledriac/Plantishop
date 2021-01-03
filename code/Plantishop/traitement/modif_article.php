<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $mysqli->set_charset("utf8");
    $sql = "UPDATE article SET type=?, nom=?, prix=?, description=? WHERE id_article=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssssd', $_POST["type"], $_POST["nom"], $_POST["prix"], $_POST["description"], $_POST["id_article"]);
    $stmt->execute();
    $id_article = $_POST["id_article"];
    if(isset($_FILES["image"])) {        
        $path = "../images/articles";
        $target_dir = $path."/";
        $nom_original = $target_dir.basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($nom_original, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if($_FILES["image"]["size"] > 500000) {
            $uploadOk = 0;
        }
        if($imageFileType != "jpg") {
            $uploadOk = 0;
        }
        if($uploadOk == 1) {
            $target_file = $target_dir."article_".$id_article.".jpg";
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }
    }
    header('location: ../article.php?id_article='.$id_article);
    die();
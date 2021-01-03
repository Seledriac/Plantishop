<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "root", "plantishop");
    $sql = "INSERT INTO article(type, nom, prix, description) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssss', $_POST["type"], $_POST["nom"], $_POST["prix"], $_POST["description"]);
    $stmt->execute();
    $sql = "SELECT id_article FROM article WHERE nom=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $_POST["nom"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $id_article = $result->fetch_assoc()["id_article"];
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
    if(file_exists($nom_original)) {
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
    header('location: ../index.php');
    die();
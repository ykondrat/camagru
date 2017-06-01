<?php
    session_start();
    $login = $_SESSION['logged_user'];
    $png = $_POST['src_png'];
    $photo = $_POST['src_photo'];
    $dir = "../photo/$login";

    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=camagru", "root", "sarkazm1312");
    } catch (PDOException $e) {
        echo "Connection error :". $e->getMessage();
        exit();
    }

    $queryCreate = "CREATE TABLE IF NOT EXISTS `photo_user` (photo_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, login VARCHAR(16) NOT NULL, path VARCHAR(50) NOT NULL)";
    try {
        $pdo->query($queryCreate);
    } catch (PDOException $e) {
        echo "Error: Can't CREATE TABLE - ".$e->getMessage();
        exit();
    }

    $photo = str_replace('data:image/png;base64,', '', $photo);
    $photo = str_replace(' ', '+', $photo);
    $photo = base64_decode($photo);

    $sql = "INSERT INTO photo_user (login) VALUES (?)";
    $result = $pdo->prepare($sql);
    $result->execute([$login]);

    $activ = "SELECT MAX(photo_id) FROM photo_user";
    $result = $pdo->prepare($activ);
    $result->execute();
    $id = $result->fetch(PDO::FETCH_ASSOC);
    $n = $id['MAX(photo_id)'];

    $activ = "UPDATE photo_user SET path = './photo/$login/$n.png' WHERE photo_id = '$n'";
    $result = $pdo->prepare($activ);
    $result->execute();
    file_put_contents("../photo/$login/$n.png", $photo);

    $Image = ImageCreateFromPNG("../photo/$login/$n.png");
    $logo = ImageCreateFromPNG(".".$png);

    if ($png == "./png/helmet.png")
        ImageCopy($Image, $logo, 88, 25, 0, 0, 200, 187);
    elseif ($png == "./png/leo.png")
        ImageCopy($Image, $logo, 88, 15, 0, 0, 200, 200);
    elseif ($png == "./png/wars.png")
        ImageCopy($Image, $logo, 88, 20, 0, 0, 200, 200);

    imagepng($Image, "../photo/$login/$n.png");


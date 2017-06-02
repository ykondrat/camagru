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

    function resizePng($im, $dst_width, $dst_height) {
        $width = imagesx($im);
        $height = imagesy($im);

        $newImg = imagecreatetruecolor($dst_width, $dst_height);

        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
        imagecopyresampled($newImg, $im, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);

        return $newImg;
    }

    if ($photo == './photo/'.$login.'/'.$login.".png") {
        $activ = "SELECT photo_id FROM photo_user WHERE path = '$photo'";
        $result = $pdo->prepare($activ);
        $result->execute();
        $id = $result->fetch(PDO::FETCH_ASSOC);
        $id = $id['photo_id'];

        $im = ImageCreateFromPNG('../photo/'.$login.'/'.$login.".png");
        $im = resizePng($im, 400, 300);
        imagepng($im, "../photo/$login/reset.png");
        $activ = "UPDATE photo_user SET path = './photo/$login/$id.png' WHERE photo_id = '$id'";
        $result = $pdo->prepare($activ);
        $result->execute();

        $Image = ImageCreateFromPNG("../photo/$login/reset.png");
        $logo = ImageCreateFromPNG(".".$png);

        if ($png == "./png/helmet.png")
            ImageCopy($Image, $logo, 88, 25, 0, 0, 200, 187);
        elseif ($png == "./png/leo.png")
            ImageCopy($Image, $logo, 88, 15, 0, 0, 200, 200);
        elseif ($png == "./png/wars.png")
            ImageCopy($Image, $logo, 88, 20, 0, 0, 200, 200);

        imagepng($Image, "../photo/$login/$id.png");
        $query = "SELECT * FROM photo_user WHERE path = $photo";
        $result = $pdo->prepare($query);
        $result->execute();

        if ($result) {
            unlink(".".$photo);

            $query = $pdo->prepare("DELETE FROM `photo_user` WHERE path = '$photo'");
            $query->execute();
        }
        unlink('../photo/'.$login.'/'.$login.".png");
        unlink('../photo/'.$login.'/reset.png');
    } else {
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
    }

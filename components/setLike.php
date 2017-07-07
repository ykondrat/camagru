<?php
    session_start();
    $login = $_SESSION['logged_user'];
    $photo = $_POST['src'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=camagru", "root", "1234");
    } catch (PDOException $e) {
        echo "Connection error :". $e->getMessage();
        exit();
    }

    $queryCreate = "CREATE TABLE IF NOT EXISTS `likes` (like_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, login VARCHAR(16) NOT NULL, path VARCHAR(50) NOT NULL)";
    try {
        $pdo->query($queryCreate);
    } catch (PDOException $e) {
        echo "Error: Can't CREATE TABLE - ".$e->getMessage();
        exit();
    }

    $query = $pdo->prepare("SELECT * FROM `likes` WHERE path='$photo' AND login = '$login'");
    $query->execute();
    $result = $query->fetchAll();

    if ($result == NULL) {
        $query = $pdo->prepare("INSERT INTO `likes` (login, path) VALUES (?, ?)");
        $query->execute([$login, $photo]);
    } else {
        $query = $pdo->prepare("DELETE FROM `likes` WHERE path = '$photo' AND login = '$login'");
        $query->execute();
    }

    $query = $pdo->prepare("SELECT * FROM `likes` WHERE path='$photo'");
    $query->execute();
    $result = $query->fetchAll();

    echo count($result);
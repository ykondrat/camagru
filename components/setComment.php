<?php
    session_start();
    $login = $_SESSION['logged_user'];
    $comment = $_POST['comment'];
    $path = $_POST['src'];
    date_default_timezone_set('Europe/Kiev');

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=camagru", "root", "1234");
    } catch (PDOException $e) {
        echo "Connection error :". $e->getMessage();
        exit();
    }

    $queryCreate = "CREATE TABLE IF NOT EXISTS `comment` (comment_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, login VARCHAR(16) NOT NULL, comment VARCHAR(50) NOT NULL, path VARCHAR(50) NOT NULL, comment_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP)";
    try {
        $pdo->query($queryCreate);
    } catch (PDOException $e) {
        echo "Error: Can't CREATE TABLE - ".$e->getMessage();
        exit();
    }

    $query = $pdo->prepare("INSERT INTO `comment` (login, comment, path) VALUES (?, ?, ?)");
    $query->execute([$login, $comment, $path]);

    $today = date("Y-m-d H:i:s");

    $str = array();
    $str[] = $login."|^|".$today."|^|".$comment;

    echo json_encode($str);
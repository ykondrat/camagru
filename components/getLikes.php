<?php
    session_start();
    $login = $_SESSION['logged_user'];
    $photo = $_POST['src'];
    $arr = array();

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=camagru", "root", "1234");
    } catch (PDOException $e) {
        echo "Connection error :". $e->getMessage();
        exit();
    }

    $query = $pdo->prepare("SELECT * FROM `likes` WHERE path='$photo'");
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $elem) {
        $arr[] = $elem['path'];
    }

    echo json_encode($arr);
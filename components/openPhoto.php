<?php
    session_start();

    $path = $_POST['src'];
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=camagru", "root", "1234");
    } catch (PDOException $e) {
        echo "Connection error :". $e->getMessage();
        exit();
    }
    $query = $pdo->prepare("SELECT * FROM `likes` WHERE path='$path'");
    $query->execute();
    $result = $query->fetchAll();
    $number = count($result);

    $query = $pdo->prepare("SELECT * FROM `comment` WHERE path='$path'");
    $query->execute();
    $result = $query->fetchAll();
    $arr = array();

    foreach ($result as $elem) {
        $arr[] = $number."|^|".$elem['login']."|^|".$elem['comment']."|^|".$elem['comment_date'];
    }
    echo json_encode($arr);

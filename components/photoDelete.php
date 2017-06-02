<?php
    session_start();
    $login = $_SESSION['logged_user'];
    $png = $_POST['src'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=camagru", "root", "");
    } catch (PDOException $e) {
        echo "Connection error :". $e->getMessage();
        exit();
    }

    $query = "SELECT * FROM photo_user WHERE path = $png";
    $result = $pdo->prepare($query);
    $result->execute();

    if ($result) {
        unlink(".".$png);

        $query = $pdo->prepare("DELETE FROM `photo_user` WHERE path = '$png'");
        $query->execute();
    }
<?php
/**
 * Created by PhpStorm.
 * User: ykondrat
 * Date: 6/1/17
 * Time: 7:44 PM
 */
    session_start();
    $login = $_SESSION['logged_user'];
    $png = $_POST['src'];
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=camagru", "root", "sarkazm1312");
    } catch (PDOException $e) {
        echo "Connection error :". $e->getMessage();
        exit();
    }

    $query = "SELECT * FROM photo_user WHERE path = $png";
    $result = $pdo->prepare($query);
    $result->execute();

    if ($result) {

    }
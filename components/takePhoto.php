<?php
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=camagru", "root", "1234");
    } catch (PDOException $e) {
        echo "Connection error :". $e->getMessage();
        exit();
    }

    $query = $pdo->prepare("SELECT path FROM `photo_user`");

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $n = count($result) - 1;
    $json = array();

    for ( ; $n >= 0; $n--) {
        array_push($json, $result[$n]['path']);
    }
    echo json_encode($json);
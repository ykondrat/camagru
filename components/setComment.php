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

    $user_name = explode("/", $path);
    $user_name = $user_name[2];

    $query = $pdo->prepare("SELECT email FROM `users` WHERE login='$user_name'");
    $query->execute();
    $email = $query->fetch(PDO::FETCH_ASSOC);
    $email = $email['email'];

    $headers = "Content-Type: text/html; charset=utf-8"."\r\n";
    $subject = "Camagru";
    $r1 = "<html><head><style>.button { background-color: #646464; border: none;color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}</style><head>";
    $r2 = "<body><h1>Hi, someone commented your photo</h1>";
    $r3 = "<article>This perfect button redirect you on Camagru site</p>";
    $r4 = "<a href='http://localhost:8080/camagru/' class='button'>Go to Camagru</a></article>";
    $r5 = "<p>Best regards, Camagru Dev</p></body></html>";
    $message = $r1.$r2.$r3.$r4.$r5;

    mail($email, $subject, $message, $headers);

    echo json_encode($str);
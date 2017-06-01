<?php
    $query = array(
        'createUsers' => 'CREATE TABLE IF NOT EXISTS `users` (user_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, login VARCHAR(16) NOT NULL, `name` VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(500) NOT NULL, activation INT DEFAULT 0)',
        'insertUser' => 'INSERT INTO `users` (login, `name`, surname, email, password, activation) VALUES (?, ?, ?, ?, ?, ?)',
        'createAvatar' => 'CREATE TABLE IF NOT EXISTS `avatar` (avatar_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, login VARCHAR(16) NOT NULL, path VARCHAR(60) NOT NULL)',
        'insertAvatar' => 'INSERT INTO `avatar` (login, path) VALUES (?, ?)'
    );

    return ($query);
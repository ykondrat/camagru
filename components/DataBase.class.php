<?php
    class DataBase {
        public static function getConnection() {
            $paramsPath = ROOT.'/config/dataBaseConnection.php';
            $params = include($paramsPath);

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=', $params['user'], $params['password']);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection error :". $e->getMessage();
                exit();
            }

            $pdo->query('CREATE DATABASE IF NOT EXISTS camagru');

            try {
                $pdo = new PDO("mysql:host={$params['host']};dbname={$params['dbname']}", $params['user'], $params['password']);
            } catch (PDOException $e) {
                echo "Connection error :". $e->getMessage();
                exit();
            }
            return $pdo;
        }

        public static function createTable($type) {
            $queryPath = ROOT.'/config/querySQL.php';
            $query = include($queryPath);

            try {
                $pdo = DataBase::getConnection();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection error :". $e->getMessage();
                exit();
            }
            $id = 'create'.ucfirst($type);
            $queryCreate = $query[$id];
            try {
                $pdo->query($queryCreate);
            } catch (PDOException $e) {
                echo "Error: Can't CREATE TABLE - ".$e->getMessage();
                exit();
            }
        }

        public function updateTable($type) {
            $queryPath = ROOT.'/config/querySQL.php';
            $query = include($queryPath);

            try {
                $pdo = $this->getConnection();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection error :". $e->getMessage();
                exit();
            }
            $id = 'update'.ucfirst($type);
            $queryUpdate = $query[$id];
            try {
                $pdo->query($queryUpdate);
            } catch (PDOException $e) {
                echo "Error: Can't UPDATE TABLE - ".$e->getMessage();
                exit();
            }
        }
    }
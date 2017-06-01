<?php
    class camagruModel {

        public static function start() {
            self::setAvatar();
            require_once (ROOT.'/view/viewCamagru.php');
        }

        public static function showAbout() {
            self::setAvatar();
            require_once (ROOT.'/view/viewAbout.php');
        }

        public static function photoRoom() {
            self::setAvatar();
            require_once (ROOT.'/view/viewPhotoRoom.php');
        }

        public static function setAvatar() {
            if (isset($_POST['set_avatar'])) {
                if ($_POST['set_avatar'] == "Send") {
                    $queryPath = ROOT.'/config/querySQL.php';
                    $querySQL = include($queryPath);

                    $pdo = DataBase::getConnection();
                    DataBase::createTable('avatar');

                    $target_dir = ROOT.'/photo/avatar/';
                    $type = explode(".", $_FILES["fileToUpload"]["name"]);
                    $len = count($type) - 1;
                    $_FILES["fileToUpload"]["name"] = $_SESSION['logged_user'].".".$type[$len];
                    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
                    $path = './photo/avatar/'.$_FILES["fileToUpload"]["name"];

                    $login = $_SESSION['logged_user'];
                    $query = $pdo->prepare("SELECT * FROM `avatar` WHERE login = '$login'");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    if ($type[$len] == "jpg" || $type[$len] == "png" || $type[$len] == "jpeg" || $type[$len] == "gif") {
                        if ($_FILES["fileToUpload"]["size"] <= 500000) {
                            if ($result == NULL) {
                                $query = $pdo->prepare($querySQL['insertAvatar']);
                                $query->execute([$login, $path]);

                                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                            } else {
                                $old_path = $result[0]['path'];

                                $query = $pdo->prepare("UPDATE `avatar` SET path = '$path' WHERE login = '$login'");
                                $query->execute();

                                $old_path = explode("/", $old_path);
                                $path = "/".$old_path[1]."/".$old_path[2]."/".$old_path[3];
                                unlink(ROOT.$path);
                                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                            }
                        } else {
                            $_SESSION['error'] = "error9";
                        }
                    } else {
                        $_SESSION['error'] = "error8";
                    }
                }
            }
            if (isset($_POST['delete_avatar'])) {
                if ($_POST['delete_avatar'] == "Delete Avatar") {
                    $pdo = DataBase::getConnection();

                    $login = $_SESSION['logged_user'];
                    $query = $pdo->prepare("SELECT * FROM `avatar` WHERE login = '$login'");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    if ($result) {
                        $old_path = $result[0]['path'];
                        $old_path = explode("/", $old_path);
                        $path = "/".$old_path[1]."/".$old_path[2]."/".$old_path[3];
                        unlink(ROOT.$path);

                        $query = $pdo->prepare("DELETE FROM `avatar` WHERE login = '$login'");
                        $query->execute();
                    }
                }
            }
        }
    }
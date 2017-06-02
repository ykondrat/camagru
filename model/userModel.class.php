<?php
    include_once ROOT.'/model/camagruModel.class.php';

    class userModel {
        public static function createAccount() {
            $queryPath = ROOT.'/config/querySQL.php';
            $querySQL = include($queryPath);

            $pdo = DataBase::getConnection();
            DataBase::createTable('users');

            if (isset($_POST['signup'])) {
                $login = $_POST['login'];
                $name = $_POST['u_name'];
                $surname = $_POST['surname'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $query_login = $pdo->prepare("SELECT * FROM `users` WHERE login = '$login'");
                $query_email = $pdo->prepare("SELECT * FROM `users` WHERE email = '$email'");

                $query_login->execute();
                $result_login = $query_login->fetchAll();

                $query_email->execute();
                $result_email = $query_email->fetchAll();

                if ($result_login == NULL && $result_email == NULL) {
                    $query = $pdo->prepare($querySQL['insertUser']);
                    $query->execute([$login, $name, $surname, $email, hash('whirlpool', $password), 0]);

                    self::activationAccount($login, $email, $name, $surname);
                } else {
                    $_SESSION['error'] = "error0";
                }
            }
            camagruModel::setAvatar();
            require_once (ROOT.'/view/viewSignUp.php');
        }

        public static function logIn() {
            $pdo = DataBase::getConnection();
            camagruModel::setAvatar();

            if (isset($_POST['logIn'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];

                $query_login = $pdo->prepare("SELECT * FROM `users` WHERE login = '$login'");
                $query_login->execute();
                $result_login = $query_login->fetchAll(PDO::FETCH_ASSOC);

                if ($result_login != NULL) {
                    if ($result_login[0]['password'] == hash('whirlpool', $password)) {
                        if ($result_login[0]['activation'] == "1") {
                            $_SESSION['logged_user'] = $login;
                            header("Location: http://localhost/camagru");
                        } else {
                            $_SESSION['error'] = "error3";
                        }
                    } else {
                        $_SESSION['error'] = "error2";
                    }
                } else {
                    $_SESSION['error'] = "error1";
                }
            }
            if (isset($_POST['forgot'])) {
                $email = $_POST['email_forgot'];

                $query = $pdo->prepare("SELECT * FROM `users` WHERE email = '$email'");
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                if ($result != NULL) {
                    if ($result[0]['activation'] == "1") {
                        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
                        $max = 16;
                        $size = strlen($chars) - 1;
                        $password = null;

                        while($max--) {
                            $password .= $chars[rand(0, $size)];
                        }

                        $new_password = hash('whirlpool', $password);

                        $query = $pdo->prepare("UPDATE `users` SET password='$new_password' WHERE email = '$email'");
                        $query->execute();

                        $name = $result[0]['name'];
                        $surname = $result[0]['surname'];
                        $headers = "Content-Type: text/html; charset=utf-8"."\r\n";
                        $subject = "Camagru New Password";
                        $r1 = "<html><head><style>span {font-weight: bold;}</style><head>";
                        $r2 = "<body><h1>Camagru New Password</h1>";
                        $r3 = "<article><p>Hi, {$name} {$surname}!</p><p>Your new password on <span>Camagru</span> site</p><p><span>$password</span></p>";
                        $r4 = "<p>Best regards, Camagru Dev</p></body></html>";
                        $message = $r1.$r2.$r3.$r4;

                        mail($email, $subject, $message, $headers);
                        $_SESSION['activation'] = "6";
                    } else {
                        $_SESSION['error'] = "error3";
                    }
                } else {
                    $_SESSION['error'] = "error7";
                }
            }
            require_once (ROOT.'/view/viewLogIn.php');
        }

        public static function logOut() {
            $_SESSION['logged_user'] = "";
            session_destroy();
            header("Location: http://localhost/camagru");
        }

        public static function modifyAccount() {
            $pdo = DataBase::getConnection();
            camagruModel::setAvatar();

            if (isset($_POST['loginAction'])) {
                if ($_POST['loginAction'] == "Accept") {
                    $new_login = $_POST['new_login'];
                    $password = $_POST['password'];
                    $login = $_SESSION['logged_user'];

                    $query_login = $pdo->prepare("SELECT * FROM `users` WHERE login = '$login'");
                    $query_login->execute();
                    $result_login = $query_login->fetchAll(PDO::FETCH_ASSOC);

                    if ($result_login != NULL) {
                        if ($result_login[0]['password'] == hash('whirlpool', $password)) {
                            $query = $pdo->prepare("SELECT * FROM `users` WHERE login = '$new_login'");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            if ($result == NULL) {
                                $query = $pdo->prepare("UPDATE `users` SET login='$new_login' WHERE login = '$login'");
                                $query->execute();
                                $_SESSION['logged_user'] = $new_login;
                                $_SESSION['activation'] = "2";
                            } else {
                                $_SESSION['error'] = "error5";
                            }
                        } else {
                            $_SESSION['error'] = "error4";
                        }
                    }
                }
            }
            if (isset($_POST['emailAction'])) {
                if ($_POST['emailAction'] == "Accept") {
                    $email = $_POST['new_email'];
                    $login = $_SESSION['logged_user'];
                    $password = $_POST['password'];

                    $query_login = $pdo->prepare("SELECT * FROM `users` WHERE login = '$login'");
                    $query_login->execute();
                    $result_login = $query_login->fetchAll(PDO::FETCH_ASSOC);

                    if ($result_login != NULL) {
                        if ($result_login[0]['password'] == hash('whirlpool', $password)) {
                            $query = $pdo->prepare("SELECT * FROM `users` WHERE email = '$email'");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            if ($result == NULL) {
                                $query = $pdo->prepare("UPDATE `users` SET email='$email' WHERE login = '$login'");
                                $query->execute();
                                $_SESSION['activation'] = "3";
                            } else {
                                $_SESSION['error'] = "error6";
                            }
                        } else {
                            $_SESSION['error'] = "error4";
                        }
                    }
                }
            }
            if (isset($_POST['passwordAction'])) {
                if ($_POST['passwordAction'] == "Accept") {
                    $newPassword = hash('whirlpool', $_POST['new_password']);
                    $password = $_POST['password'];
                    $login = $_SESSION['logged_user'];

                    $query_login = $pdo->prepare("SELECT * FROM `users` WHERE login = '$login'");
                    $query_login->execute();
                    $result_login = $query_login->fetchAll(PDO::FETCH_ASSOC);

                    if ($result_login != NULL) {
                        if ($result_login[0]['password'] == hash('whirlpool', $password)) {
                            $query = $pdo->prepare("UPDATE `users` SET password='$newPassword' WHERE login = '$login'");
                            $query->execute();
                            $_SESSION['activation'] = "4";
                        } else {
                            $_SESSION['error'] = "error4";
                        }
                    }
                }
            }
            require_once (ROOT.'/view/viewModify.php');
        }

        public static function activationAccount($login, $email, $name, $surname) {
            $pdo = DataBase::getConnection();
            camagruModel::setAvatar();
            $login = strtolower($login);
            $name = ucfirst($name);
            $surname = ucfirst($surname);

            $query = $pdo->prepare("SELECT user_id FROM `users` WHERE login='$login'");
            $query->execute();

            $id = $query->fetch(PDO::FETCH_ASSOC);

            $activation = hash('whirlpool', $id['user_id']);
            $headers = "Content-Type: text/html; charset=utf-8"."\r\n";
            $subject = "Camagru Account Activation";
            $r1 = "<html><head><style>.button { background-color: #646464; border: none;color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;}</style><head>";
            $r2 = "<body><h1>Camagru Account Activation</h1>";
            $r3 = "<article><p>Hi, {$name} {$surname}!</p><p>Thanks for registration on <span>Camagru<span></p><p>To activate your account on site please click on button below</p>";
            $r4 = "<a href='http://localhost/camagru/activation/{$login}/{$activation}' class='button'>Activate</a></article>";
            $r5 = "<p>Best regards, Camagru Dev</p></body></html>";
            $message = $r1.$r2.$r3.$r4.$r5;

            mail($email, $subject, $message, $headers);
            $_SESSION['activation'] = "0";
        }

        public static function setActivation($login, $id) {
            $pdo = DataBase::getConnection();
            camagruModel::setAvatar();

            if (isset($login) && isset($id)) {
                $query = $pdo->prepare("SELECT user_id FROM `users` WHERE login='$login'");
                $query->execute();

                $active = $query->fetch(PDO::FETCH_ASSOC);
                $active = hash('whirlpool', $active['user_id']);

                if ($active == $id) {
                    $query = $pdo->prepare("UPDATE `users` SET activation='1' WHERE login = '$login'");
                    $query->execute();
                    $_SESSION['activation'] = "5";
                }
            }
            header("Location: http://localhost/camagru");
        }
    }
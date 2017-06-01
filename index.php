<?php
    error_reporting(-1);
    ini_set('display_errors','on');
    session_start();

    define('ROOT', dirname(__FILE__));
    require_once(ROOT.'/components/Router.class.php');
    require_once(ROOT.'/components/DataBase.class.php');
    
    if (!isset($_SESSION['logged_user'])) {
        $_SESSION['logged_user'] = "";
    }
    if (!isset($_SESSION['error'])) {
        $_SESSION['error'] = "";
    }
    if (!isset($_SESSION['activation'])) {
        $_SESSION['activation'] = "";
    }

    $router = new Router();
    $router->runRouter();

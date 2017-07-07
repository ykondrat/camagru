<?php
    session_start();
    $login = $_SESSION['logged_user'];
    $arr = array();
    $arr[] = $login;
    echo json_encode($arr);
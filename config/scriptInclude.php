<?php
    if ($_SESSION['error'] == "error0") {
        echo "<script>usedLogin()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error1") {
        echo "<script>noSuchUser()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error2") {
        echo "<script>incorrectPass()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error3") {
        echo "<script>nonActive()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error4") {
        echo "<script>incorrectPasswordModify()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error5") {
        echo "<script>incorrectLoginModify()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error6") {
        echo "<script>incorrectEmailModify()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error7") {
        echo "<script>noSuchEmail()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error8") {
        echo "<script>wrongFormat()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['error'] == "error9") {
        echo "<script>wrongSize()</script>";
        $_SESSION['error'] = "";
    }
    if ($_SESSION['activation'] == "0") {
        echo "<script>sendEmail()</script>";
        $_SESSION['activation'] = "";
    }
    if ($_SESSION['activation'] == "2") {
        echo "<script>changeLoginSuccess()</script>";
        $_SESSION['activation'] = "";
    }
    if ($_SESSION['activation'] == "3") {
        echo "<script>changeEmailSuccess()</script>";
        $_SESSION['activation'] = "";
    }
    if ($_SESSION['activation'] == "4") {
        echo "<script>changePasswordSuccess()</script>";
        $_SESSION['activation'] = "";
    }
    if ($_SESSION['activation'] == "5") {
        echo "<script>activationSuccess()</script>";
        $_SESSION['activation'] = "";
    }
    if ($_SESSION['activation'] == "6") {
        echo "<script>sendNewPassword()</script>";
        $_SESSION['activation'] = "";
    }
<?php
    if ($_SESSION['logged_user'] != "") {
        $pdo = DataBase::getConnection();
        $login = $_SESSION['logged_user'];

        $query = $pdo->prepare("SELECT * FROM `avatar` WHERE login = '$login'");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($result != NULL) {
            $path = $result[0]['path'];
        } else {
            $path = "./photo/avatar/user_avatar.png";
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="ykondrat" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Play" />
    <link rel="stylesheet" href="./css/app.css" />
    <link rel="stylesheet" href="./css/menuStyle.css" />
    <link rel="stylesheet" href="./css/form.css" />
    <link rel="stylesheet" href="./css/modifyForm.css" />
    <link rel="stylesheet" href="./css/modal.css" />
    <link rel="stylesheet" href="./css/photoRoom.css" />
<!--    <link rel="stylesheet" href="./css/responsive" />-->
    <title>Camagru</title>
</head>
<body>
    <nav>
        <?php
            if ($_SESSION['logged_user'] != "") {
                echo "<img src='{$path}' alt='avatar' id='avatar'><br>";
                echo "<span id='nick_name'>".$_SESSION['logged_user']."</span>";
            }
        ?>
        <ul class="menu">
            <li class="menu_list"><a href="http://localhost:8080/camagru"><i class="fa fa-home fa-2x" aria-hidden="true"></i><span>&nbsp; Home</span></a></li>
            <?php
                if ($_SESSION['logged_user'] === "") {
                    echo "<li class=\"menu_list\"><a href='http://localhost:8080/camagru/sign_up'><i class=\"fa fa-user-plus fa-2x\" aria-hidden=\"true\"></i><span>&nbsp; Sign Up</span></a></li>";
                    echo "<li class=\"menu_list\"><a href='http://localhost:8080/camagru/login'><i class=\"fa fa-sign-in fa-2x\" aria-hidden=\"true\"></i><span>&nbsp; Sign In</span></a></li>";
                } else {
                    echo "<li class=\"menu_list\"><a href='http://localhost:8080/camagru/modify'><i class=\"fa fa-user-circle-o fa-2x\" aria-hidden=\"true\"></i><span>&nbsp; Modify Account</span></a></li>";
                    echo "<li class=\"menu_list\"><a href='http://localhost:8080/camagru/logout'><i class=\"fa fa-sign-out fa-2x\" aria-hidden=\"true\"></i><span>&nbsp; Log Out</span></a></li>";
                }
            ?>
            <li class="menu_list"><a href="http://localhost:8080/camagru/photo_room"><i class="fa fa-camera-retro fa-2x" aria-hidden="true"></i><span>&nbsp; Photo Room</span></a></li>
            <li class="menu_list"><a href="http://localhost:8080/camagru/about"><i class="fa fa-book fa-2x" aria-hidden="true"></i><span>&nbsp; About</span></a></li>
        </ul>
    </nav>
    <div id="upload" class="modal_window">
        <form class="modal_form" action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Upload your avatar</legend>
                <input type="file" name="fileToUpload" id="fileToUpload"/>
                <input type="submit" name="set_avatar" value="Send" />
                <input type="submit" name="delete_avatar" value="Delete Avatar" id="delete_avatar"/>
            </fieldset>
        </form>
    </div>
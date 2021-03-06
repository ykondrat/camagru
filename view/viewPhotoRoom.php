<?php
    require_once (ROOT.'/view/viewHeader.php');

    if ($_SESSION['logged_user'] != "") {
        ?>
        <div class="container">
        <div class="room">
            <video id="video" autoplay></video>
            <button id="take_it" class="btn-modify">Take photo</button>
            <canvas id="canvas" width="400" height="300"></canvas>
            <?php
                $pdo = DataBase::getConnection();
                $login = $_SESSION['logged_user'];
                $query = $pdo->prepare("SELECT path FROM `photo_user` WHERE login = '$login'");

                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                if ($result) {
                    $flag = 0;
                    $n = count($result);
                    for ($i = 0; $i < $n; $i++) {
                        $src = $result[$i]['path'];
                        if ($src == "./photo/" . $login . "/" . $login . ".png") {
                            $flag = 1;
                            break;
                        }
                    }
                    if ($flag) {
                        $src = "./photo/" . $login . "/" . $login . ".png";
                        echo "<img src='$src' id=\"photo\" alt=\"Photo\">";
                    } else {
                        echo '<img src="./photo/avatar/user_avatar.png" id="photo" alt="Photo"/>';
                    }
                } else {
                    echo '<img src="./photo/avatar/user_avatar.png" id="photo" alt="Photo"/>';
                }
            ?>
            <button id="save_it" class="btn-modify">Save photo</button>
            <button id="cancel_it" class="btn-modify">Cancel photo</button>
            <div class="items">
                <img src="./png/helmet.png" alt="helmet" id="helmet" class="item_png"/>
                <img src="./png/leo.png" alt="vader" id="leo" class="item_png"/>
                <img src="./png/wars.png" alt="wars" id="wars" class="item_png"/>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="photo_form">
                <div class="photo_p">If you don't have Web camera you may upload <strong>png file.</strong></div>
                <input type="file" name="photoToUpload" id="photoToUpload"/>
                <input type="submit" name="set_photo" value="Send" id="sendPhoto"/>
            </form>
        </div>
        <div class="photo_div">
            <h2 style="margin-bottom: 10px">To delete photo click on it =)</h2>
            <?php
                $pdo = DataBase::getConnection();
                $login = $_SESSION['logged_user'];
                $query = $pdo->prepare("SELECT path FROM `photo_user` WHERE login = '$login'");

                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                $n = count($result) - 1;
                for ($i = 0 ; $n >= 0; $n--) {
                    $src = $result[$n]['path'];
                    if ($src != "./photo/".$login."/".$login.".png") {
                        echo "<img src='$src' alt='user photo' class='user_photo' onclick='deletePhoto(this)'>";
                        if ($i % 2 != 0) {
                            echo "<br>";
                        }
                    }
                    $i++;
                }
            ?>
        </div>
        </div>
        <script src="./js/takePhoto.js" language="JavaScript"></script>
        <?php
    } else {
        ?>
        <div class="container">
            <h1>Only logged user can use Photo room</h1>
        </div>
<?php
    }
    require_once (ROOT.'/view/viewFooter.php');
?>
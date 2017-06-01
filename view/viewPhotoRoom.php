<?php
    require_once (ROOT.'/view/viewHeader.php');
?>
    <div class="room">
        <video id="video" width="400" height="300" autoplay></video>
        <button id="take_it" class="btn-modify">Take photo</button>
        <canvas id="canvas" width="400" height="300"></canvas>
        <img src="./photo/avatar/user_avatar.png" id="photo" alt="Photo" />
    </div>
    <div class="items">
        <img src="./png/helmet.png" alt="helmet" id="helmet" class="item_png" />
        <img src="./png/vader.png" alt="vader" id="vader" class="item_png" />
        <img src="./png/wars.png" alt="wars" id="wars" class="item_png" />
    </div>
    <script src="./js/takePhoto.js" language="JavaScript"></script>
<?php
    require_once (ROOT.'/view/viewFooter.php');
?>
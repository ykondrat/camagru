    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var photo = document.getElementById('photo');
    var vendorUrl = window.URL || window.webkitURL;
    var div = document.createElement("div");
    var insert = document.getElementsByTagName('room')[0];
    var elem = document.getElementsByClassName("error_div")[0];

    function insertAfter(elem, refElem) {
        var parent = refElem.parentNode;
        var next = refElem.nextSibling;

        if (next) {
            return parent.insertBefore(elem, next);
        } else {
            return parent.appendChild(elem);
        }
    }

    navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

    navigator.getMedia({
        video: true,
        audio: false
    }, function (stream) {
        video.src = vendorUrl.createObjectURL(stream);
        video.play();
    }, function (error) {
        console.log(error);

        if (elem) {
            elem.parentElement.removeChild(elem);
        }
        div.className = "error_div";
        div.innerHTML = "Sorry, error with cam, try later";
        insert.insertBefore(div, insert.firstChild);
    });

    context.translate(canvas.width, 0);
    context.scale(-1, 1);

    document.getElementById('take_it').addEventListener('click', function () {
        context.drawImage(video, 0, 0, 400, 300);
        photo.setAttribute('src', canvas.toDataURL('image/png'));
        document.getElementById('take_it').style.display = "none";
        document.getElementById('save_it').style.display = "block";
        document.getElementById('cancel_it').style.display = "block";
        var videoImg = document.getElementById('video_img');
        var src = videoImg.getAttribute("src");
        var elem = document.createElement('img');
        var photo_item = document.getElementById('photo');

        elem.setAttribute('src', src);
        elem.setAttribute('id', 'done_img');
        insertAfter(elem, photo_item);
    });

    var helmet = document.getElementById('helmet');
    var leo = document.getElementById('leo');
    var wars = document.getElementById('wars');

    helmet.onclick = function (){
        document.getElementById('take_it').style.display = "block";
        var elem = document.createElement('img');
        var video = document.getElementById('video');
        var videoImg = document.getElementById('video_img');
        var done_img = document.getElementById('done_img');
        var photo_item = document.getElementById('photo');
        photo_item.setAttribute("src", "./photo/avatar/user_avatar.png");

        document.getElementById('save_it').style.display = "none";
        document.getElementById('cancel_it').style.display = "none";
        if (videoImg) {
            videoImg.parentElement.removeChild(videoImg);
        }
        if (done_img) {
            done_img.parentElement.removeChild(done_img);
        }
        elem.setAttribute('src', helmet.getAttribute('src'));
        elem.setAttribute('id', 'video_img');

        insertAfter(elem, video);
    };

    leo.onclick = function (){
        document.getElementById('take_it').style.display = "block";
        var elem = document.createElement('img');
        var video = document.getElementById('video');
        var videoImg = document.getElementById('video_img');
        var done_img = document.getElementById('done_img');
        var photo_item = document.getElementById('photo');
        photo_item.setAttribute("src", "./photo/avatar/user_avatar.png");

        document.getElementById('save_it').style.display = "none";
        document.getElementById('cancel_it').style.display = "none";
        if (videoImg) {
            videoImg.parentElement.removeChild(videoImg);
        }
        if (done_img) {
            done_img.parentElement.removeChild(done_img);
        }
        elem.setAttribute('src', leo.getAttribute('src'));
        elem.setAttribute('id', 'video_img');

        insertAfter(elem, video);
    };


    wars.onclick = function (){
        document.getElementById('take_it').style.display = "block";
        var elem = document.createElement('img');
        var video = document.getElementById('video');
        var videoImg = document.getElementById('video_img');
        var done_img = document.getElementById('done_img');
        var photo_item = document.getElementById('photo');
        photo_item.setAttribute("src", "./photo/avatar/user_avatar.png");

        document.getElementById('save_it').style.display = "none";
        document.getElementById('cancel_it').style.display = "none";
        if (videoImg) {
            videoImg.parentElement.removeChild(videoImg);
        }
        if (done_img) {
            done_img.parentElement.removeChild(done_img);
        }
        elem.setAttribute('src', wars.getAttribute('src'));
        elem.setAttribute('id', 'video_img');
        insertAfter(elem, video);
    };

    document.getElementById('cancel_it').onclick = function() {
        var videoImg = document.getElementById('video_img');
        var done_img = document.getElementById('done_img');

        if (videoImg) {
            videoImg.parentElement.removeChild(videoImg);
        }
        if (done_img) {
            done_img.parentElement.removeChild(done_img);
        }
        document.getElementById('save_it').style.display = "none";
        document.getElementById('cancel_it').style.display = "none";
        document.getElementById('photo').setAttribute("src", "./photo/avatar/user_avatar.png");
    };

    document.getElementById('save_it').onclick = function() {
        var srcPng = document.getElementById('done_img').getAttribute("src");
        var srcPhoto = document.getElementById('photo').getAttribute("src");
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.open("POST", "./components/photoMerge.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("src_png=" + srcPng + "&src_photo=" + srcPhoto);
        location.reload(true);
    };

    function deletePhoto(photo) {
        var src = photo.getAttribute("src");

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.open("POST", "./components/photoDelete.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("src=" + src);
        location.reload(true);
    }
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var photo = document.getElementById('photo');
    var vendorUrl = window.URL || window.webkitURL;
    var div = document.createElement("div");
    var insert = document.getElementsByTagName('room')[0];
    var elem = document.getElementsByClassName("error_div")[0];

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
    });

    function insertAfter(elem, refElem) {
        var parent = refElem.parentNode;
        var next = refElem.nextSibling;

        if (next) {
            return parent.insertBefore(elem, next);
        } else {
            return parent.appendChild(elem);
        }
    }

    var helmet = document.getElementById('helmet');
    var vader = document.getElementById('vader');
    var wars = document.getElementById('wars');

    helmet.onclick = function (){
        document.getElementById('take_it').style.display = "block";
        var elem = document.createElement('img');
        var video = document.getElementById('video');
        var videoImg = document.getElementById('video_img');

        if (videoImg) {
            videoImg.parentElement.removeChild(videoImg);
        }

        elem.setAttribute('src', helmet.getAttribute('src'));
        elem.setAttribute('id', 'video_img');

        insertAfter(elem, video);
    };

    vader.onclick = function (){
        document.getElementById('take_it').style.display = "block";
        var elem = document.createElement('img');
        var video = document.getElementById('video');
        var videoImg = document.getElementById('video_img');

        if (videoImg) {
            videoImg.parentElement.removeChild(videoImg);
        }

        elem.setAttribute('src', vader.getAttribute('src'));
        elem.setAttribute('id', 'video_img');

        insertAfter(elem, video);
        elem.style.height = "286px";
    };


    wars.onclick = function (){
        document.getElementById('take_it').style.display = "block";
        var elem = document.createElement('img');
        var video = document.getElementById('video');
        var videoImg = document.getElementById('video_img');

        if (videoImg) {
            videoImg.parentElement.removeChild(videoImg);
        }

        elem.setAttribute('src', wars.getAttribute('src'));
        elem.setAttribute('id', 'video_img');
        insertAfter(elem, video);
    };
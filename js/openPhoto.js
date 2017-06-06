var user = "";

function insertAfter(elem, refElem) {
    var parent = refElem.parentNode;
    var next = refElem.nextSibling;

    if (next) {
        return parent.insertBefore(elem, next);
    } else {
        return parent.appendChild(elem);
    }
}

function getLoggedUser() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "./components/getUser.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send();

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var result = JSON.parse(xmlhttp.responseText);

            user = result[0];
        }
    }
}
getLoggedUser();
function openPhoto(photo) {
    var deleteDiv = document.getElementById('modal_photo');
    if (deleteDiv) {
        deleteDiv.parentElement.removeChild(deleteDiv);
    }

    var src = photo.getAttribute('src');
    var modalDiv = document.createElement('div');

    modalDiv.className = "modal_window_img";
    modalDiv.id = "modal_photo";

    var imgClose = document.createElement('img');
    imgClose.className = "img_close";
    imgClose.setAttribute("src", "./png/x.png");
    imgClose.setAttribute("onclick", "closeImg()");

    document.body.insertBefore(modalDiv, document.body.firstChild);

    var insertDiv = document.createElement('div');
    insertDiv.className = "modal_form_img";
    modalDiv.insertBefore(insertDiv, modalDiv.lastChild);

    var img = document.createElement('img');
    img.setAttribute("src", src);
    img.className = "open_img";
    insertDiv.insertBefore(img, insertDiv.lastChild);

    var i = document.createElement('i');
    var br = document.createElement('br');
    var br2 = document.createElement('br');
    i.className = "fa fa-thumbs-up";
    i.id = "likePhotoId";
    i.setAttribute('aria-hidden', 'true');
    if (user) {
        i.setAttribute('onclick', 'sendLike()');
    }
    insertAfter(br2, img);
    insertAfter(i, br2);

    var textarea = document.createElement('textarea');
    textarea.setAttribute("rows", "4");
    textarea.setAttribute("cols", "40");
    textarea.id = "textareaId";
    var button = document.createElement('button');
    button.innerText = "Send Comment";
    button.id = "buttonID";
    button.setAttribute('onclick', 'sendComment()');
    insertAfter(br, i);
    if (!user) {
        textarea.setAttribute('disabled', true);
    }
    insertAfter(textarea, br);
    insertAfter(button, textarea);
    var divComment = document.createElement('div');
    divComment.id = "comment_div";
    insertAfter(divComment, button);
    modalDiv.insertBefore(imgClose, modalDiv.firstChild);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "./components/openPhoto.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("src=" + src);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var result = JSON.parse(xmlhttp.responseText);

            for (var i = 0; result[i]; i++) {
                var tmp = result[i].split("|^|");

                if (tmp[0] != 0) {
                    document.getElementById('likePhotoId').innerText = " " + tmp[0];
                }
                var divWithComment = document.createElement('div');
                divWithComment.className = "div_with_comment";
                var pData = document.createElement('p');
                var pComment = document.createElement('p');
                var strong = document.createElement('strong');

                strong.innerText = tmp[1] + " ";
                pData.className = "p_data";
                pComment.className = "p_comment";
                pData.innerText = " " + tmp[3];
                pData.insertBefore(strong, pData.lastChild);
                pComment.innerText = tmp[2];
                divWithComment.insertBefore(pData, divWithComment.firstChild);
                insertAfter(pComment, pData);
                divComment.insertBefore(divWithComment, divComment.firstChild);
            }
        }
    }
}

function closeImg() {
    document.getElementById('modal_photo').style.display = "none";
    var deleteDiv = document.getElementById('modal_photo');

    if (deleteDiv) {
        deleteDiv.parentElement.removeChild(deleteDiv);
    }
}

function sendLike() {
    var xmlhttp = new XMLHttpRequest();
    var src = document.getElementsByClassName('open_img')[0].getAttribute('src');

    xmlhttp.open("POST", "./components/setLike.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("src=" + src);

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (JSON.parse(xmlhttp.responseText) != '0') {
                document.getElementById('likePhotoId').innerText = " " + JSON.parse(xmlhttp.responseText);
            } else {
                document.getElementById('likePhotoId').innerText = "";
            }
        }
    }
}

function sendComment() {
    var xmlhttp = new XMLHttpRequest();
    var comment = document.getElementById('textareaId').value;

    if (comment) {
        var src = document.getElementsByClassName('open_img')[0].getAttribute('src');
        document.getElementById('textareaId').value = "";

        xmlhttp.open("POST", "./components/setComment.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("comment=" + comment + "&src=" + src);

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var result = JSON.parse(xmlhttp.responseText);
                var tmp = result[0].split("|^|");

                var divComment = document.getElementById('comment_div');
                var divWithComment = document.createElement('div');
                divWithComment.className = "div_with_comment";
                var pData = document.createElement('p');
                var pComment = document.createElement('p');
                var strong = document.createElement('strong');

                strong.innerText = tmp[0] + " ";
                pData.className = "p_data";
                pComment.className = "p_comment";
                pData.innerText = " " + tmp[1];
                pData.insertBefore(strong, pData.lastChild);
                pComment.innerText = tmp[2];
                divWithComment.insertBefore(pData, divWithComment.firstChild);
                insertAfter(pComment, pData);
                divComment.insertBefore(divWithComment, divComment.firstChild);
            }
        }
    }
}
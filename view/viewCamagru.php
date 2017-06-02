<?php
    require_once (ROOT.'/view/viewHeader.php');
?>
    <div class="container">
        <script>
            var xmlhttp = new XMLHttpRequest();

            function insertAfter(elem, refElem) {
                var parent = refElem.parentNode;
                var next = refElem.nextSibling;

                if (next) {
                    return parent.insertBefore(elem, next);
                } else {
                    return parent.appendChild(elem);
                }
            }

            xmlhttp.open("POST", "./components/takePhoto.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send();

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var result = JSON.parse(xmlhttp.responseText);
                    var photoCount = result.length - 1;

                    var photoArray = new Array();

                    while (photoCount >= 0) {
                        var photo = new Array();

                        for (var i = 0; i < 9; i++) {
                            if (result[photoCount]) {
                                photo.push(result[photoCount]);
                            }
                            photoCount--;
                        }
                        photoArray.push(photo);
                    }

                    var page = location.href.split('/');
                    var insert = document.getElementsByClassName('container')[0];

                    if (!page[page.length - 1]) {
                        for (var y = 0; photoArray[0][y]; y++) {
                            var img = document.createElement('img');
                            img.setAttribute('src', photoArray[0][y]);
                            img.className = "photo_gallery";
                            insert.insertBefore(img, insert.firstChild);

                            if (y % 3 == 0) {
                                var br = document.createElement('br');
                                insertAfter(br, img);
                            }
                        }
                    } else {
                        var index = page[page.length - 1];
                        if (photoArray[index]) {
                            for (var z = 0; photoArray[index][z]; z++) {
                                var img = document.createElement('img');
                                img.setAttribute('src', photoArray[0][z]);
                                img.className = "photo_gallery";
                                insert.insertBefore(img, insert.firstChild);

                                if (z % 3 == 0) {
                                    var br = document.createElement('br');
                                    insertAfter(br, img);
                                }
                            }
                        }
                    }
                }
            };
        </script>
    </div>

<?php
    require_once (ROOT.'/view/viewFooter.php');
?>


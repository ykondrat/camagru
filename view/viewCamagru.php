<?php
    require_once (ROOT.'/view/viewHeader.php');
?>
    <div class="header_gallery">
        <h1>Camagru Gallery</h1>
    </div>
    <div class="container">
        <script>
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("POST", "./components/takePhoto.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send();

            function insertAfter(elem, refElem) {
                var parent = refElem.parentNode;
                var next = refElem.nextSibling;

                if (next) {
                    return parent.insertBefore(elem, next);
                } else {
                    return parent.appendChild(elem);
                }
            }

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var result = JSON.parse(xmlhttp.responseText);

                    if (result[0]) {
                        var photoArray = new Array();

                        for (var k = 0; result[k];) {
                            var photo = new Array();

                            for (var i = 0; i < 9; i++) {
                                if (result[k]) {
                                    photo.push(result[k]);
                                }
                                k++;
                            }
                            photoArray.push(photo);
                        }
                        var page = location.href.split('/');
                        var insert = document.getElementsByClassName('container')[0];

                        if (!page[page.length - 1] || page[page.length - 1] == '1') {
                            for (var y = 8; y >= 0; y--) {
                                if (photoArray[0][y]) {
                                    var img = document.createElement('img');
                                    img.setAttribute('src', photoArray[0][y]);
                                    img.className = "photo_gallery";
                                    img.setAttribute("onclick", "openPhoto(this)");
                                    insert.insertBefore(img, insert.firstChild);

                                    if (y == 2 || y == 5 || y == 8) {
                                        var br = document.createElement('br');
                                        insertAfter(br, img);
                                    }
                                }
                            }
                        } else {
                            var index = parseInt(page[page.length - 1]) - 1;

                            if (photoArray[index]) {
                                for (var z = 8; z >= 0; z--) {
                                    if (photoArray[index][z]) {
                                        var img = document.createElement('img');
                                        img.setAttribute('src', photoArray[index][z]);
                                        img.className = "photo_gallery";
                                        img.setAttribute("onclick", "openPhoto(this)");
                                        insert.insertBefore(img, insert.firstChild);

                                        if (z == 2 || z == 5 || z == 8) {
                                            var br = document.createElement('br');
                                            insertAfter(br, img);
                                        }
                                    }
                                }
                            }
                        }
                        var pagination = photoArray.length;
                        var current_page = page[page.length - 1];

                        if (!current_page) {
                            current_page = 1;
                        } else {
                            current_page = parseInt(current_page);
                        }

                        var div = document.createElement('div');
                        div.className = "div_pagination";
                        insert.insertBefore(div, insert.lastChild);
                        function print(value) {
                            if (value <= pagination || value == "<" || value == ">" || value == "...") {
                                var a = document.createElement('a');
                                if (!isNaN(value)) {
                                    if (value == 1) {
                                        a.href = '/camagru/';
                                    } else {
                                        a.href = '/camagru/' + value;
                                    }
                                }
                                if (value == "<") {
                                    var pagePrev = page[page.length - 1] - 1;
                                    if (pagePrev) {
                                        a.href = '/camagru/' + pagePrev;
                                    } else {
                                        a.href = '/camagru/';
                                    }
                                }
                                if (value == ">") {
                                    var pageNext = parseInt(page[page.length - 1]) + 1;

                                    if (!pageNext) {
                                        pageNext = 2;
                                    }

                                    if (pageNext <= pagination) {
                                        a.href = '/camagru/' + pageNext;
                                    } else {
                                        a.href = '/camagru/';
                                    }
                                }
                                a.innerText = value + ' ';
                                a.className = "pagination";

                                insert.insertBefore(a, insert.lastChild);
                            }
                        }

                        function updatePageLinks(current, allPages) {
                            if (allPages == 0) {
                                return;
                            }
                            if (current > 1) {
                                print("<");
                            }
                            print(1);
                            if (current > 2) {
                                print("...");
                                if (current === allPages && allPages > 3) {
                                    print(current - 2);
                                }
                                print(current - 1);
                            }
                            if (current != 1 && current != allPages) {
                                print(current);
                            }
                            if (current < allPages - 1) {
                                print(current + 1);
                                if (current == 1 && allPages > 3) {
                                    print(current + 2);
                                }
                                print("...");
                            }
                            if (allPages != 1) {
                                print(allPages);
                            }
                            if (current < allPages) {
                                print(">");
                            }
                        }

                        updatePageLinks(current_page, pagination);
                    }
                }
            };
        </script>
    </div>

<?php
    require_once (ROOT.'/view/viewFooter.php');
?>


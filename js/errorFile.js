var insert = document.getElementsByTagName('legend')[1];
var elem = document.getElementsByClassName("error_div")[0];

function noSuchUser() {
    var div = document.createElement("div");
    
    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    div.className = "error_div";
    div.innerHTML = "Incorrect login";
    insert.insertBefore(div, insert.firstChild);
}

function incorrectPass() {
    var div = document.createElement("div");

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    div.className = "error_div";
    div.innerHTML = "Incorrect password";
    insert.insertBefore(div, insert.firstChild);
}

function nonActive() {
    var div = document.createElement("div");

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    div.className = "error_div";
    div.innerHTML = "Check your email, and activate you account";
    insert.insertBefore(div, insert.firstChild);
}

function noSuchEmail() {
    var div = document.createElement("div");

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    div.className = "error_div";
    div.innerHTML = "No such email";
    insert.insertBefore(div, insert.firstChild);
}

function wrongFormat() {
    var elem = document.getElementsByClassName("error_div")[0];
    var insert = document.getElementsByClassName('container')[0];
    var div = document.createElement("div");

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    div.className = "error_div";
    div.innerHTML = "Wrong format of avatar. Use only jpg, png, jpeg, gif.";
    insert.insertBefore(div, insert.firstChild);
}

function wrongSize() {
    var elem = document.getElementsByClassName("error_div")[0];
    var insert = document.getElementsByClassName('container')[0];
    var div = document.createElement("div");

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    div.className = "error_div";
    div.innerHTML = "Sorry, your file is too large.";
    insert.insertBefore(div, insert.firstChild);
}

function wrongFormatPhoto() {
    var elem = document.getElementsByClassName("error_div")[0];
    var insert = document.getElementsByClassName('container')[0];
    var div = document.createElement("div");

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    div.className = "error_div";
    div.innerHTML = "Wrong format of photo. Use only .png";
    insert.insertBefore(div, insert.firstChild);
}
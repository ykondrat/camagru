var insert = document.getElementsByTagName('legend')[1];

function sendEmail() {
    var elemSuccess = document.getElementsByClassName("success_div")[0];
    var div = document.createElement("div");

    if (elemSuccess) {
        elemSuccess.parentElement.removeChild(elemSuccess);
    }
    div.className = "success_div";
    div.innerHTML = "On your email was sent a link to activate your account";
    insert.insertBefore(div, insert.firstChild);
}

function activationSuccess() {
    var elemSuccess = document.getElementsByClassName("success_div")[0];
    var insertActivation = document.getElementsByClassName('container')[0];
    var div = document.createElement("div");

    if (elemSuccess) {
        elemSuccess.parentElement.removeChild(elemSuccess);
    }
    div.className = "success_div";
    div.innerHTML = "Your account was successfully activated";
    insertActivation.insertBefore(div, insertActivation.firstChild);
}
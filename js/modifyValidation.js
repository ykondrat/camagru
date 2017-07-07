var insertLogin = document.getElementsByTagName('legend')[1];
var insertEmail = document.getElementsByTagName('legend')[2];
var insertPassword = document.getElementsByTagName('legend')[3];

function modifyValidationLogin() {
    var login = document.forms["modify1"]["new_login"].value;
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    if (login.length < 8 || login.length > 16) {
        var div = document.createElement("div");

        div.className = "error_div";
        div.innerHTML = "Login must be between 8 and 16 symbols";
        insertLogin.insertBefore(div, insertLogin.firstChild);

        return (false);
    }
    return (true);
}

function modifyValidationEmail() {
    var email = document.forms["modify2"]["new_email"].value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    if (!filter.test(email)) {
        var div = document.createElement("div");

        div.className = "error_div";
        div.innerHTML = "Please provide a valid email address";
        insertEmail.insertBefore(div, insertEmail.firstChild);
        return (false);
    }
    return (true);
}

function modifyValidationPassword() {
    var password = document.forms["modify3"]["new_password"].value;
    var filterPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    if (!filterPassword.test(password)) {
        var div = document.createElement("div");

        div.className = "error_div";
        div.innerHTML = "Password must include minimum 8 symbols at least 1 uppercase alphabet, 1 lowercase alphabet and 1 number";
        insertPassword.insertBefore(div, insertPassword.firstChild);
        return (false);
    }
    return (true);
}
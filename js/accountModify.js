var changeLogin = document.getElementById('changeLogin');
var loginInputs = document.getElementById('input_change_login');

var changePassword = document.getElementById('changePassword');
var passwordInputs = document.getElementById('input_change_password');

var changeEmail = document.getElementById('changeEmail');
var emailInputs = document.getElementById('input_change_email');

if (changeLogin) {
    changeLogin.onclick = function () {

        if (changePassword.style.display == "block" || !changePassword.style.display) {
            changePassword.style.display = "none";
        } else {
            changePassword.style.display = "block";
        }
        if (changeEmail.style.display == "block" || !changeEmail.style.display) {
            changeEmail.style.display = "none";
        } else {
            changeEmail.style.display = "block";
        }
        if (loginInputs.style.display == "none" || !loginInputs.style.display) {
            loginInputs.style.display = "block";
        } else {
            loginInputs.style.display = "none";
        }
    }
}

if (changeEmail) {
    changeEmail.onclick = function () {
        if (changePassword.style.display == "block" || !changePassword.style.display) {
            changePassword.style.display = "none";
        } else {
            changePassword.style.display = "block";
        }
        if (changeLogin.style.display == "block" || !changeLogin.style.display) {
            changeLogin.style.display = "none";
        } else {
            changeLogin.style.display = "block";
        }
        if (emailInputs.style.display == "none" || !emailInputs.style.display) {
            emailInputs.style.display = "block";
        } else {
            emailInputs.style.display = "none";
        }
    }
}

if (changePassword) {
    changePassword.onclick = function () {
        if (changeEmail.style.display == "block" || !changeEmail.style.display) {
            changeEmail.style.display = "none";
        } else {
            changeEmail.style.display = "block";
        }
        if (changeLogin.style.display == "block" || !changeLogin.style.display) {
            changeLogin.style.display = "none";
        } else {
            changeLogin.style.display = "block";
        }
        if (passwordInputs.style.display == "none" || !passwordInputs.style.display) {
            passwordInputs.style.display = "block";
        } else {
            passwordInputs.style.display = "none";
        }
    }
}

function changeLoginSuccess() {
    var insert = document.getElementsByClassName('account_form')[0];
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    var div = document.createElement("div");

    div.className = "success_div";
    div.innerHTML = "Login was successfully changed";
    insert.insertBefore(div, insert.firstChild);
}

function changeEmailSuccess() {
    var insert = document.getElementsByClassName('account_form')[0];
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    var div = document.createElement("div");

    div.className = "success_div";
    div.innerHTML = "Email was successfully changed";
    insert.insertBefore(div, insert.firstChild);
}

function changePasswordSuccess() {
    var insert = document.getElementsByClassName('account_form')[0];
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    var div = document.createElement("div");

    div.className = "success_div";
    div.innerHTML = "Password was successfully changed";
    insert.insertBefore(div, insert.firstChild);
}

function incorrectPasswordModify() {
    var insert = document.getElementsByClassName('account_form')[0];
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    var div = document.createElement("div");

    div.className = "error_div";
    div.innerHTML = "Incorrect password";
    insert.insertBefore(div, insert.firstChild);
}

function incorrectLoginModify() {
    var insert = document.getElementsByClassName('account_form')[0];
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    var div = document.createElement("div");

    div.className = "error_div";
    div.innerHTML = "Login is already in use";
    insert.insertBefore(div, insert.firstChild);
}

function incorrectEmailModify() {
    var insert = document.getElementsByClassName('account_form')[0];
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    var div = document.createElement("div");

    div.className = "error_div";
    div.innerHTML = "Email is already in use";
    insert.insertBefore(div, insert.firstChild);
}

function sendNewPassword() {
    var insert = document.getElementsByClassName('account_form')[0];
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    var div = document.createElement("div");

    div.className = "success_div";
    div.innerHTML = "New password was sent on your email";
    insert.insertBefore(div, insert.firstChild);
}
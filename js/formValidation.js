var insert = document.getElementsByTagName('legend')[1];

function formValidationSignUp() {
    var login = document.forms["SignUp"]["login"].value.trim();
    var name = document.forms["SignUp"]["u_name"].value.trim();
    var surname = document.forms["SignUp"]["surname"].value.trim();
    var email = document.forms["SignUp"]["email"].value;
    var password = document.forms["SignUp"]["password"].value;
    var repeatPassword = document.forms["SignUp"]["repeat_password"].value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var filterPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    var cmp = password.localeCompare(repeatPassword);
    var elem = document.getElementsByClassName("error_div")[0];
    var div = document.createElement("div");

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    if (login.length < 8 || login.length > 16) {
        div.className = "error_div";
        div.innerHTML = "Login must be between 8 and 16 symbols";
        insert.insertBefore(div, insert.firstChild);

        return (false);
    }
    if (name.length < 1) {
        div.className = "error_div";
        div.innerHTML = "Please provide your name";
        insert.insertBefore(div, insert.firstChild);

        return (false);
    }
    if (surname.length < 1) {
        div.className = "error_div";
        div.innerHTML = "Please provide your surname";
        insert.insertBefore(div, insert.firstChild);

        return (false);
    }
    if (!filter.test(email)) {
        div.className = "error_div";
        div.innerHTML = "Please provide a valid email address";
        insert.insertBefore(div, insert.firstChild);

        return (false);
    }
    if (!filterPassword.test(password)) {
        div.className = "error_div";
        div.innerHTML = "Password must include minimum 8 symbols at least 1 uppercase alphabet, 1 lowercase alphabet and 1 number";
        insert.insertBefore(div, insert.firstChild);

        return (false);
    }
    if (cmp != 0) {
        document.forms["SignUp"]["password"].style = "background: #D78A8A;";
        document.forms["SignUp"]["repeat_password"].style = "background: #D78A8A;";

        div.className = "error_div";
        div.innerHTML = "Please provide a valid password";
        insert.insertBefore(div, insert.firstChild);

        return (false);
    }
    return (true);
}

function usedLogin() {
    var div = document.createElement("div");
    var elem = document.getElementsByClassName("error_div")[0];

    if (elem) {
        elem.parentElement.removeChild(elem);
    }
    div.className = "error_div";
    div.innerHTML = "Login or email is already in use";
    insert.insertBefore(div, insert.firstChild);
}
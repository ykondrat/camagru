<?php
    require_once (ROOT.'/view/viewHeader.php');
?>
    <div class="container">
        <div class="account_form">
            <form name="SignUp" onsubmit="return (formValidationSignUp())" method="post">
                <fieldset>
                    <legend>Create Account</legend>
                    <input type="text" name="login" placeholder="login">
                    <input type="text" name="u_name" placeholder="name">
                    <input type="text" name="surname" placeholder="surname">
                    <input type="email" name="email" placeholder="e-mail">
                    <input type="password" name="password" placeholder="password">
                    <input type="password" name="repeat_password" placeholder="repeat password">
                    <input type="submit" name="signup" value="Sign Up" />
                </fieldset>
            </form>
        </div>
    </div>
<?php
    require_once (ROOT.'/view/viewFooter.php');
?>

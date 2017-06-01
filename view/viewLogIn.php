<?php
    require_once (ROOT.'/view/viewHeader.php');
?>
    <div class="container">
        <div class="account_form">
            <form id="login_form" name="logIn" action="login" method="post">
                <fieldset>
                    <legend>Log In</legend>
                    <input type="text" name="login" placeholder="login" required>
                    <input type="password" name="password" placeholder="password" required>
                    <input type="submit" name="logIn" value="Sign In" />
                </fieldset>
            </form>
            <button id="modal_controller">Forgot password?</button>
        </div>
        <div id="modal" class="modal_window">
            <form class="modal_form" action="" method="post">
                <fieldset>
                    <legend>Forgot password?</legend>
                    <input type="email" name="email_forgot" placeholder="Enter your email" required>
                    <input type="submit" name="forgot" value="Send" />
                </fieldset>
            </form>
        </div>
    </div>
<?php
    require_once (ROOT.'/view/viewFooter.php');
?>
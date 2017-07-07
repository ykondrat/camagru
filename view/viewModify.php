<?php
    require_once (ROOT.'/view/viewHeader.php');
?>
    <div class="container">
        <div class="account_form">
            <!-- Action Login -->
            <button class="btn-modify" id="changeLogin">Change Login</button>
            <div id="input_change_login">
                <form name="modify1" action="modify" method="post" onsubmit="return (modifyValidationLogin())">
                    <fieldset>
                        <legend>Modify Your Login</legend>
                        <input type="text" name="new_login" placeholder="Enter new login" />
                        <input type="password" name="password" placeholder="Enter password" />
                        <input type="submit" name="loginAction" value="Accept" />
                    </fieldset>
                </form>
            </div>
            <!-- Action Email -->
            <button class="btn-modify" id="changeEmail">Change Email</button>
            <div id="input_change_email">
                <form name="modify2" action="modify" method="post" onsubmit="return (modifyValidationEmail())">
                    <fieldset>
                        <legend>Modify Your Email</legend>
                            <input type="email" name="new_email" placeholder="Enter new email" />
                            <input type="password" name="password" placeholder="Enter password" />
                            <input type="submit" name="emailAction" value="Accept" />
                    </fieldset>
                </form>
            </div>
            <!-- Action Password -->
            <button class="btn-modify" id="changePassword">Change Password</button>
            <div id="input_change_password">
                <form name="modify3" action="modify" method="post" onsubmit="return (modifyValidationPassword())">
                    <fieldset>
                        <legend>Modify Your Password</legend>
                            <input type="password" name="new_password" placeholder="Enter new password" />
                            <input type="password" name="password" placeholder="Enter old password" />
                            <input type="submit" name="passwordAction" value="Accept" />
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<?php
    require_once (ROOT.'/view/viewFooter.php');
?>
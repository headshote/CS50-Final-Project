<form action="reset_password.php" method="post">
    <div style="margin: 0 auto">
        <p style="text-align: center">If you forgot password and entred email address during registration, <br/>
        old password will be changed to randomly generated and<br/>
        this new password will be sent to that email.
        </p><br/>
    </div>
    <fieldset>
        <div class="control-group">
            <input autofocus name="username" placeholder="Username" type="text"/>
        </div>
        <div class="control-group">
            <input name="email" placeholder="E-mail" type="text"/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Rest password</button>
        </div>
    </fieldset>
</form>


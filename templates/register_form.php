<form action="register.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="username" placeholder="Username" type="text"/>
        </div>
        <div class="control-group">
            <input name="password" placeholder="Password" type="password"/>
        </div>
        <div class="control-group">
            <input name="confirmation" placeholder="Confirm password" type="password"/>
        </div>
        <div class="control-group">
            <input name="email" placeholder="E-mail address (optional)" type="text"/>
        </div>
        <div class="control-group" style="margin-left:auto; margin-right:auto; ">
        <?php
          require_once('../includes/recaptchalib.php');
          echo recaptcha_get_html($publickey);
        ?>
        </div> 
        <div class="control-group">
            <button type="submit" class="btn">Register</button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login.php">log in</a>
</div>

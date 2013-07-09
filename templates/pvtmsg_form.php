<form enctype="multipart/form-data"  action="pvtmsg.php" method="post" >
    <fieldset> 
        <input type="hidden" name="usr" value="<?= $usr?>" />
        <div>
            <p>
                Sending message to <b><?= $usr ?></b>.
            </p>
        </div>      
        <div class="control-group">
            <textarea name="message" placeholder="Message, up to 1000 symbols" rows="6" maxlength=1000 ></textarea>            
        </div>        
        <div class="control-group" style="text-align:center; margin-left:auto; margin-right:auto; ">
        <?php
            require_once('../includes/recaptchalib.php');
            echo recaptcha_get_html($publickey);
        ?>
        </div>   
        <div class="control-group">
            <button type="submit" class="btn">Send message</button>
        </div>
    </fieldset>
</form>

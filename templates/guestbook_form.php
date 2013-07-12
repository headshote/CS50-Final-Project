<form enctype="multipart/form-data"  action="guestbook.php" method="post" >
    <fieldset> 
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />       
        <div class="control-group">
            <textarea name="message" placeholder="Message, up to 1000 symbols" rows="6" maxlength=1000></textarea>            
        </div>
        <div class="control-group">
            <input id="file" name="file" type="file" style="display:none">
            <div  class="input-append" >
               <input  placeholder="Image to upload (optional)" id="photoCover" class="input-large" type="text">
               <a class="btn" onclick="$('input[id=file]').click();">Browse</a>
            </div>
            <script type="text/javascript">
            $('input[id=file]').change(function() {
               $('#photoCover').val($(this).val());
            });
            </script>
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
<p>Pages:  
   <?php
            $pages = ceil($len / MAXPOSTS);
            $j = 0;
            while ( $j<$pages )
            {
                if($j == $page )
                {
                    echo "<u>$j</u> ";
                    echo " ";   
                }
                else
                {
                    echo "<a href='guestbook.php?page=$j'>$j</a> "; 
                    echo " ";
                }                
                $j++;
            } 
    ?>
</p>
<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
    <thead>
        <tr>
            <th>Username</th>
            <th>Date/Time</th>
            <th>Image</th>  
            <th>Message</th>                       
        </tr>
    </thead>
    <tbody>
        
        <?php $i=MAXPOSTS*$page; while ( ( $i<= (MAXPOSTS*$page+MAXPOSTS-1) ) && ( $i<$len ) && ($i>=0) ): ?>

        <tr>
            <td><a href="pvtmsg.php?usr=<?= $messages[$i][0] ?>"><?= $messages[$i][0] ?></a></td>
            <td><?=  date("s",$messages[$i][2]) ?>.<?= date("s",$messages[$i][3]) ?>.<?= $messages[$i][4] ?>, <?= date("s",$messages[$i][5]) ?>:<?= date("s",$messages[$i][6]) ?></td>
            <td> <?php if($messages[$i][7]!=false): ?><div id="container" style="width: 300px; height: 300px; overflow: hidden"><a href=<?="uloads/".$messages[$i][7]?>><img src=<?="uloads/".$messages[$i][7] ?> /></a></div><?php endif ?> </td>          
            <?php $mess = nl2br( htmlspecialchars( $messages[$i][1] ) ); ?>
            <td><div id="container" style="width: 800px;  overflow: auto"><?= strip_tags($mess, "<br>") ?></div></td>
        </tr>

        <?php $i++; endwhile ?>
    </tbody>
</table>
<p>Pages: 
    <?php
            $pages = ceil($len / MAXPOSTS);
            $j = 0;
            while ( $j<$pages )
            {
                if($j == $page )
                {
                    echo "<u>$j</u> ";   
                    echo " ";
                }
                else
                {
                    echo "<a href='guestbook.php?page=$j'>$j</a> "; 
                    echo " ";
                }              
                $j++;
            } 
    ?>
</p>

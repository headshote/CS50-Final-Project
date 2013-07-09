<p>
    <?php if($mode==="in"): ?>
            See: <u>Incoming mail</u> <a href='mymail.php?mode=out'>Outgoing mail</a>
    <?php elseif($mode==="out"): ?>
            See: <a href='mymail.php?mode=in'>Incoming mail</a> <u>Outgoing mail</u>
     <?php endif ?> 

</p>
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
                    echo "<a href='mymail.php?page=$j&mode=$mode'>$j</a> ";
                    echo " "; 
                }             
                $j++;
            } 
    ?>
</p>
<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
    <thead>
        <tr>
            <?php if($mode==="in"): ?>
                <th>Sender</th>
            <?php elseif($mode==="out"): ?>
                <th>Receiver</th>
            <?php endif ?>            
            <th>Date/Time</th>            
            <th>Message</th>                       
        </tr>
    </thead>
    <tbody>
        <?php $i=MAXPOSTS*$page; while ( ( $i<= (MAXPOSTS*$page+MAXPOSTS-1) ) && ( $i<$len ) && ($i>=0)  ): ?>

        <tr>
            <td><a href="pvtmsg.php?usr=<?= $messages[$i]["username"] ?>"><?= $messages[$i]["username"] ?></a></td>
            <td><?= $messages[$i]["date"] ?></td>         
            <?php $mess = nl2br( htmlspecialchars( $messages[$i]["msg"] ) ); ?>
            <td><div id="container" style="width: 900px;  overflow: auto"><?= strip_tags($mess, "<br>") ?></div></td>
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
                    echo "<a href='mymail.php?page=$j&mode=$mode'>$j</a> "; 
                    echo " ";
                }                  
                $j++;
            } 
    ?>
</p>

<?php

    require("../includes/config.php");
    
    if( empty( $_GET["mode"] ) || ($_GET["mode"] === "in" ) )
    {
        $messages = query(" SELECT username, date, msg FROM users JOIN pmessages ON users.id = pmessages.fromusr WHERE tousr = ? ORDER BY  `pmessages`.`date` DESC ", $_SESSION["id"] ); 
        $len = count($messages);
        if ( empty($_GET["page"]) )
        {
            render("mymail_form.php", ["mode"=>"in", "title" => "My private mail", "messages" => $messages, "page"=>0, "len"=>$len]);
        }
        else
        {
            render("mymail_form.php", ["mode"=>"in", "title" => "My private mail", "messages" => $messages, "page"=>$_GET["page"], "len"=>$len]);
        }
    }
    else if( $_GET["mode"] === "out" )
    {
        $messages = query(" SELECT username, date, msg FROM users JOIN pmessages ON users.id = pmessages.tousr WHERE fromusr = ? ORDER BY  `pmessages`.`date` DESC ", $_SESSION["id"] ); 
        $len = count($messages);
        if ( empty($_GET["page"]) )
        {
            render("mymail_form.php", ["mode"=>"out", "title" => "My private mail", "messages" => $messages, "page"=>0, "len"=>$len]);
        }
        else
        {
            render("mymail_form.php", ["mode"=>"out", "title" => "My private mail", "messages" => $messages, "page"=>$_GET["page"], "len"=>$len]);
        }
    }
    else
    {
        redirect("mymail.php");
    }
?>

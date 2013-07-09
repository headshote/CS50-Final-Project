<?php

    require("../includes/config.php"); 
    require_once('../includes/recaptchalib.php');
    $reCapHandler = fopen("../recaptcha.csv", 'r');
    $reCapKeys = fgetcsv($reCapHandler);
    $privatekey = $reCapKeys[0];
    $publickey = $reCapKeys[1];
     
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ( strlen($_POST["message"]) > 1000 )
        {
            apologize("Message was too long (1000 symbols max).");
        }
        $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
        if (!$resp->is_valid) 
        {
            // What happens when the CAPTCHA was entered incorrectly
            apologize ("The reCAPTCHA wasn't entered correctly. Go back and try it again."."(reCAPTCHA said: ".$resp->error . ")");
        }
        else
        {
            // Your code here to handle a successful verification            
            $qresult1 = query("SELECT id FROM users WHERE username = ?", $_POST["usr"]);            
            query("INSERT INTO pmessages (tousr, fromusr, date, msg) VALUES(?,?,NOW(),?)", $qresult1[0]["id"], $_SESSION["id"], $_POST["message"] );
            inform("Message sent!");
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if ( empty($_GET["usr"]) )
        {
            redirect("/");
        }
        else if(  query("SELECT * FROM users WHERE username = ?", $_GET["usr"]) !=false )
        {
            $messages=[];
            render("pvtmsg_form.php", [ "title" => "Private message", "messages"=>$messages, "usr"=>$_GET["usr"], "publickey"=>$publickey ]);
        }
        else
        {
            apologize("Username doesn't exist");
        }
    }
    else
    {
        redirect("/");
    }

?>

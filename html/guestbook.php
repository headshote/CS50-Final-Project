<?php
    require("../includes/config.php");     
    require_once('../includes/recaptchalib.php');
    $reCapHandler = fopen("../recaptcha.csv", 'r');
    $reCapKeys = fgetcsv($reCapHandler);
    $privatekey = $reCapKeys[0];
    $publickey = $reCapKeys[1];
    
    if( $_SERVER["REQUEST_METHOD"] == "POST")
    {
        //message text processing
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
            $handle = fopen("../messages.csv", "a"); 
            $date = getdate();
            $usrn = query("SELECT username FROM users WHERE id =?", $_SESSION["id"]);  
            
            //upload processing
            if( !empty($_FILES['file']['name']) )
            {
                $allowedExts = array("jpg", "jpeg", "gif", "png");
                $tmp = explode(".", $_FILES["file"]["name"]);
                $extension = end($tmp);
                if ( (   ($_FILES["file"]["type"] == "image/gif")
                      || ($_FILES["file"]["type"] == "image/jpeg")
                      || ($_FILES["file"]["type"] == "image/png")
                      || ($_FILES["file"]["type"] == "image/pjpeg")  )
                    && in_array($extension, $allowedExts) )
                { 
                    $uind = uload_index();
                    $fname = $uind.".".$extension;
                    fputcsv( $handle, [ $usrn[0]["username"], $_POST["message"] , $date["mday"], $date["mon"], $date["year"], $date["hours"], $date["minutes"], $fname ]);
                    fclose($handle);      
                    $uploaddir = 'uloads/';
                    $uploadfile = $uploaddir . $fname;
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);       
                    chmod($uploadfile, 0755); 
                }
                else
                {
                    fclose($handle);
                    apologize("Invalid file format/File too big.");
                }
            }
            else
            {
                fputcsv( $handle, [ $usrn[0]["username"], $_POST["message"] , $date["mday"], $date["mon"], $date["year"], $date["hours"], $date["minutes"], '']);
                fclose($handle);
            }
            
            inform("Message sent!");
        }
        
    }
    else if( $_SERVER["REQUEST_METHOD"] == "GET")
    {
        $handle = fopen("../messages.csv", "r");
        $rows = [];
        $i = 0;
        while ( ($data = fgetcsv($handle)) !== FALSE )
        {        
            $rows[$i] = $data;
            $i++;
        }
        fclose($handle);
        $len = count($rows);
        if ( empty($_GET["page"]) )
        {
            render("guestbook_form.php", ["messages" => $rows, "title"=>"Guestbook", "page"=>0, "len"=>$len, "publickey"=>$publickey ]);
        }
        else
        {
            render("guestbook_form.php", ["messages" => $rows, "title"=>"Guestbook", "page"=>$_GET["page"], "len"=>$len, "publickey"=>$publickey ]);
        }
    }

?>

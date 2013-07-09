<?php
    
    require_once("PHPMailer/class.phpmailer.php");
    require("../includes/config.php");

    // if form was submitted
    if ( !empty($_SESSION["id"]) )
    {
        redirect("/");
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $res = query("SELECT * FROM users WHERE username = ? AND email = ?", $_POST["username"], $_POST["email"] );
        if( $res == false)
        {
            apologize("You entered incorrect username/email pair");
        }
        else
        {
            $newpass = mt_rand(100000, 999999);   
            //To send mail to registered user, store info in csv file in format:
            //smtp.server.something, port, mail@server, password         
            $mailHandler = fopen("../mailpass.csv", 'r');
            $mailpass = fgetcsv($mailHandler);
                    // instantiate mailer
            $mail = new PHPMailer();
                    
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->Host       = $mailpass[0]; // SMTP server
            //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                                                   // 1 = errors and messages
                                                                   // 2 = messages only
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = $mailpass[1];                    // set the SMTP port for the GMAIL server
            $mail->Username   = $mailpass[2]; // SMTP account username
            $mail->Password   = $mailpass[3];
                    
            $mail->SetFrom($mailpass[2]);
            $address = $_POST["email"];
            $mail->AddAddress($address);
            $mail->Subject    = "Resetting password";
            $mail->Body    = "Your new password is: ". (string)$newpass;                 
                        
            if(!$mail->Send()) 
            {
                apologize('Mailer error: ' . $mail->ErrorInfo);
            } 
            else
            {
                //Update database with new password only if successfully sent mail with new password
                query("UPDATE users SET hash = ? WHERE username = ? ", crypt($newpass) ,$_POST["username"] );
                // redirect to portfolio
                redirect("/");
            }  
        }         
    }
    else
    {
        // else render form
        render("reset_password_form.php", ["title" => "Rest password"]);
    }
    
?>

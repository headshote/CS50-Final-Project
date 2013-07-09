<?php

    // configuration
    require_once("PHPMailer/class.phpmailer.php");
    require("../includes/config.php");
    require_once('../includes/recaptchalib.php');
    $reCapHandler = fopen("../recaptcha.csv", 'r');
    $reCapKeys = fgetcsv($reCapHandler);
    $privatekey = $reCapKeys[0];
    $publickey = $reCapKeys[1];
    
    // if form was submitted
    if ( !empty($_SESSION["id"]) )
    {
        redirect("/");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must provide your password confirmation.");
        }
        else if ( $_POST["password"] !== $_POST["confirmation"])
        {
            apologize("Password and confirmation aren't equal.");
        }
        else if (!empty($_SESSION["id"]) )
        {
            redirect("/");
        }
        else
        {
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
                if (!empty($_POST["email"]) ) //case where user entred email
                {
                    //To send mail to registered user, store info in csv file in format:
                    //smtp.serve.something, port, mail@server, password
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
                    $mail->Subject    = "Registration";
                    $mail->Body    = "You registered for CS50 finance!"; 
                    
                    if(!$mail->Send()) 
                    {
                        apologize('Mailer error: Possibly incorrect Email address. ' . $mail->ErrorInfo);
                    }
                    else 
                    {
                        // query to create new user
                        $res = query("INSERT INTO users (username, hash, cash, email) VALUES(?, ?, 12000.00, ?)", $_POST["username"], crypt($_POST["password"]), $_POST["email"] );
                        if ( $res === false )
                        {
                            apologize("Couldn't create an account. Perhaps you entered alredy existing username or email.");
                        }
                        //if successful registration, and no prob with mail, log user in
                        $rows = query("SELECT LAST_INSERT_ID() AS id");
                        $id = $rows[0]["id"]; 
                        $_SESSION["id"] = $id;
                        // redirect to portfolio
                        redirect("/");
                    }
                }
                else //case where user didn't provide email
                {
                    // query to create new user
                    $res = query("INSERT INTO users (username, hash, cash, email) VALUES(?, ?, 12000.00, NULL)", $_POST["username"], crypt($_POST["password"]) );
                    if ( $res === false )
                    {
                        apologize("Couldn't create an account. Perhaps you entered alredy existing username or email.");
                    }
                    //if successful registration, log user in
                    $rows = query("SELECT LAST_INSERT_ID() AS id");
                    $id = $rows[0]["id"]; 
                    $_SESSION["id"] = $id; 
                }
                redirect("/");///////////////////////////////////////
            }            
        }
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register", "publickey"=>$publickey]);
    }

?>

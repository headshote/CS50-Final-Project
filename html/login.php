<?php

    // configuration
    require("../includes/config.php"); 
    require_once('../includes/recaptchalib.php');
    $privatekey = "6LfGrd0SAAAAAAheP85N5t3OZDQVJZvd9uOWr-H8";

    // if form was submitted
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
        else
        {
            
            // query database for user
            $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

            // if we found user, check password
            if (count($rows) == 1)
            {
                // first (and only) row
                $row = $rows[0];

                // compare hash of user's input against hash that's in database
                if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
                {
                    // remember that user's now logged in by storing user's ID in session
                    $_SESSION["id"] = $row["id"];

                    // redirect to portfolio
                    redirect("/");
                }
            }

            // else apologize
            apologize("Invalid username and/or password.");
        }
        
    }
    else if( empty($_SESSION["id"]) )
    {
        // else render form
        render("login_form.php", ["title" => "Log In"]);
    }
    //if already logged in just show main
    else
    {
        redirect("/");
    }

?>

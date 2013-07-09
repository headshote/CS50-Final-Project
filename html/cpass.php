<?php
    require("../includes/config.php");
    if ( $_SERVER["REQUEST_METHOD"] == "POST")
    {
        $qwr = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"] );
        if (empty($_POST["password"]))
        {
            apologize("You must provide new password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must provide your new password's confirmation.");
        }
        else if ( $_POST["password"] !== $_POST["confirmation"])
        {
            apologize("Password and confirmation aren't equal.");
        }
        else if ( crypt($_POST["oldpassword"], $qwr[0]["hash"]) != $qwr[0]["hash"] )
        {
           apologize("Incorrect old password.");
        }
        query("UPDATE users SET hash = ? WHERE id = ?", crypt($_POST["password"]), $_SESSION["id"]);
        redirect("/");
    }
    else
    {
        render( "cpass_form.php", ["title" => "Change password"] );
    }
?>

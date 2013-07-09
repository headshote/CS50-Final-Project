<?php
    require("../includes/config.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ( preg_match("/^\d+$/", $_POST["shares"]) )
        {
            $symbol = strtoupper($_POST["symbol"]);
            $stock = lookup($symbol);
            $date = getdate();  
            if ($stock === false)
            {
                apologize("Incorrect stock symbol.");
            }
            $usrdata = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
            if ( $stock["price"]*$_POST["shares"] > $usrdata[0]["cash"] )
            {
                apologize("Not enough money on account to purchase shares.");
            }
            $handle = fopen("../log.csv", "a"); 
            query("INSERT INTO shares (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $symbol, $_POST["shares"]);
            $money = $stock["price"] * $_POST["shares"] ;
            query("UPDATE users SET cash = cash - ? WHERE id = ?", $money, $_SESSION["id"]);
            fputcsv($handle, [ "BOUGHT", $symbol, $_POST["shares"], $stock["price"], $date["mday"], $date["mon"], $date["year"], $date["hours"], $date["minutes"], $_SESSION["id"]  ]);
            fclose($handle);
            redirect("/");
        }
        apologize("Incorrect amount of shares to buy.");
        
    }       
    else
    {
        render("buy_form.php",["title" => "Buy shares"]);
    }
?>

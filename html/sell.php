<?php
    require("../includes/config.php");
    $shares = query("SELECT * FROM shares WHERE id = ?", $_SESSION["id"]);
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $handle = fopen("../log.csv", "a");        
        $stock = lookup($_POST["symbol"]); 
        $date = getdate();              
        foreach( $shares as $share)
        {
            if ( $share["symbol"] == $_POST["symbol"] )
            {
                $money = $stock["price"] * $share["shares"] ;
                $hue = query("UPDATE users SET cash = cash + ? WHERE id = ?", $money, $_SESSION["id"]);
                $lel = query("DELETE FROM shares WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"] );
                fputcsv($handle, [ "SOLD", $_POST["symbol"], $share["shares"], $stock["price"], $date["mday"], $date["mon"], $date["year"], $date["hours"], $date["minutes"], $_SESSION["id"]  ]);                                
            }
        }
        fclose($handle);
        redirect("/");        
    }
    else
    {    
        render("sell_form.php", ["shares" => $shares,"title" => "Sell owned stocks"]);
    }
?>

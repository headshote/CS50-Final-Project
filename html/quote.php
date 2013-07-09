<?php
    require("../includes/config.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ( empty($_POST["symbol"]) )
        {
            apologize("You must provide symbol.");
        } 
        $stock = lookup( $_POST["symbol"]);       
        if ($stock === false)
        {
            apologize("Symbol is nowhere to be found.");
        }
        else
        {
            //render("quote_output.php", $stock); // - use without javascript thing
            $price = number_format($stock['price'], 2);
            print 'A share of<b> ' .$stock['name']. ' </b>costs <b>$' . $price . "</b>.";
        }
    }
    else
    {
        render("quote_input.php", ["title" => "Get Quote"]);
    }
?>

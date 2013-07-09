<?php

    // configuration
    require("../includes/config.php"); 
    
    $rows = query("SELECT * FROM shares WHERE id = ?", $_SESSION["id"]);
    
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
            ];
        }
    }
    
    $lastrow = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    
    // render portfolio
    render("portfolio.php", ["cash" => $lastrow[0]["cash"], "positions" => $positions, "title" => "Portfolio"]);

?>

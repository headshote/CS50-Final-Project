<?php
    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // load suggestion data
        $data = @file_get_contents("http://d.yimg.com/aq/autoc?query={$_POST['symbol']}&region=US&lang=en-US&callback=YAHOO.util.ScriptNodeDataSource.callbacks");

        // parse yahoo data into a list of symbols
        $result = [];
        $json = json_decode(substr($data, strlen('YAHOO.util.ScriptNodeDataSource.callbacks('), -1));
        foreach ($json->ResultSet->Result as $stock)
        $result[] = $stock;

        echo json_encode(['symbols' => $result]);
    }
?>

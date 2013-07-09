<?
    require("../includes/config.php");
    $handle = fopen("../log.csv", "r");
    $rows = [];
    $i = 0;
    while ( ($data = fgetcsv($handle)) !== FALSE )
    { 
        if($data[9] == $_SESSION["id"])
        {       
            $rows[$i] = $data;
        }
        $i++;
    }
    fclose($handle);
    render("history_form.php", ["rows" => $rows, "title" => "History of transactions"]);
?>

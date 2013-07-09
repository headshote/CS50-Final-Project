<table class="table table-striped">

    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>

    <tbody>
        <!-- using date("s", $varible) here on $variable with small integers (less than 60 ), to trick
        date() into believing it's printing seconds, to get formatted number that loks like 00, 01, etc., because 
        printf was misbehaving-->
        <!-- day.month.year -->
        <?php foreach ($rows as $row): ?>        
        <tr><td><?= $row[0] ?></td><td><?=  date("s",$row[4]) ?>.<?= date("s",$row[5]) ?>.<?= $row[6] ?>, <?= date("s",$row[7]) ?>:<?= date("s",$row[8]) ?></td><td><?= $row[1] ?></td><td><?= $row[2] ?></td><td>$<?= number_format($row[3],2) ?></td></tr>    
        <?php endforeach ?>
    </tbody>

</table>

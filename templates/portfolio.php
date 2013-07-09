<form >
    <fieldset>
        <div class="control-group">
            <input id="search" autofocus name="filter" placeholder="Filter available stocks" type="text"/>
        </div>        
    </fieldset>
</form>
<table class="table table-striped" id ="table-portfolio" >

    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach ($positions as $position): ?>

    <tr>
        <td><?= $position["symbol"] ?></td>
        <td><?= $position["name"] ?></td>
        <td><?= $position["shares"] ?></td>        
        <td>$<?= number_format($position["price"],2) ?></td>
        <td>$<?= number_format($position["shares"]*$position["price"],2) ?></td>
    </tr>

    <? endforeach ?>
    
    <tr>
        <td colspan="4">CASH</td>
        <td>$<?= number_format($cash,2) ?></td>
    </tr>    
    </tbody>
    
</table>

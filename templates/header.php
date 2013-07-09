<!DOCTYPE html>

<html>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
             var RecaptchaOptions = {
                theme : 'white'
             };
        </script>                
        <script>
            $(document).ready(function() {

                // create autocomplete
                $('#form-buy input[name=symbol]').on('keyup', function() {

                    // load autocomplete data from suggest.php
                    $.ajax({
                        url: 'suggest_more.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            symbol: $(this).val()
                        },
                        success: function(response) {
                            // build html string for a list of suggestions
                            var suggestions = '<ul>';
                            for (var i in response.symbols)
                                suggestions += '<li><a href="#" class="suggestion" data-symbol="' + response.symbols[i].symbol + '">' + 
                                    response.symbols[i].name + '</a></li>';

                            // display list of suggestions
                            suggestions += '</ul>';
                            $('#bsuggestions').html(suggestions);
                        }
                    });
                });

                // set value of symbol field when a suggestion is clicked
                $('#bsuggestions').on('click', '.suggestion', function() {
                    $('#form-buy input[name=symbol]').val($(this).attr('data-symbol'));
                });
               
            });
        </script>
        <script>
            $(document).ready(function() {

                // create autocomplete
                $('#form-quote input[name=symbol]').on('keyup', function() {

                    // load autocomplete data from suggest.php
                    $.ajax({
                        url: 'suggest_more.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            symbol: $(this).val()
                        },
                        success: function(response) {
                            // build html string for a list of suggestions
                            var suggestions = '<ul>';
                            for (var i in response.symbols)
                                suggestions += '<li><a href="#" class="suggestion" data-symbol="' + response.symbols[i].symbol + '">' + 
                                    response.symbols[i].name + '</a></li>';

                            // display list of suggestions
                            suggestions += '</ul>';
                            $('#suggestions').html(suggestions);
                        }
                    });
                });

                // set value of symbol field when a suggestion is clicked
                $('#suggestions').on('click', '.suggestion', function() {
                    $('#form-quote input[name=symbol]').val($(this).attr('data-symbol'));
                });

                // load data via ajax when form is submitted
                $('#form-quote').on('submit', function() {

                    // determine symbol
                    var symbol = $('#form-quote input[name=symbol]').val();

                    // send request to quote.php
                    $.ajax({
                        url: 'quote.php',
                        type: 'POST',
                        data: {
                            symbol: symbol
                        },
                        success: function(response) {
                            $('#price').html(response);
                        }
                    });

                    // since we're overridding form submission, make sure it doesn't submit
                    return false;
                });
            });
        </script>
        <script>
            $(document).ready(function() {

                // key pressed in search field, so filter table
                $('#search').on('keyup', function() {

                    // determine symbol we're searching for
                    var query = $(this).val();

                    // iterate over each row in the table
                    $('#table-portfolio tbody tr').each(function(e) {

                        // check if the symbol cell contains the query
                        if (!query || $(this).children().first().text().toLowerCase().indexOf(query) > -1)
                            $(this).show();

                        // no match, so hide row
                        else
                            $(this).hide();
                    });
                });                
            });
        </script>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>C$50 Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>C$50 Finance</title>
        <?php endif ?>

        <script src="js/jquery-1.8.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">                
                <a href="/"><img alt="C$50 Finance" src="img/logo.gif"/></a>                                
                <table style="margin-left:auto; margin-right:auto; ">
                    <tbody>                        
                        <tr>
                            <td>                               
                                    <ul id="nav" class="nav nav-pills" style="z-index:100">
                                        <?php if( !empty($_SESSION["id"]) ): ?>
                                        <?php if (isset($title)): ?>
                                            <li id="title"><b><?= htmlspecialchars($title) ?></li></b>
                                        <?php else: ?>
                                            <li id="title"><b>C$50 Finance</b>
                                            </li>
                                        <?php endif ?>
                                           
                                        <li ><a href="/">Yahoo! Finance</a>
                                            <ul>
                                                <li><a href="quote.php">Quote</a></li>
                                                <li><a href="buy.php">Buy</a></li>
                                                <li><a href="sell.php">Sell</a></li>
                                                <li><a href="history.php">History</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li><a href="#">Website Features</a>
                                            <ul>
                                                <li><a href="guestbook.php">Guestbook</a></li>
                                            </ul>
                                        </li>  
                                        <li><a href="#"><b><?php $un = query("SELECT username FROM users WHERE id =?", $_SESSION["id"]); print $un[0]["username"]; ?></b></a>
                                        <ul>
                                            <li><a href="mymail.php">My private mail</a></li>
                                            <li><a href="cpass.php"><strong>Change password</strong></a></li>                   
                                            <li><a href="logout.php"><strong>Log Out</strong></a></li>
                                        </ul>
                                        </li>
                                        <?php endif ?>                                    
                                    </ul>
                                
                            </td>                              
                        </tr>
                    </tbody>    
                </table>                               
            </div>

            <div id="middle">

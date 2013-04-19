<?php
session_start();
?>

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div>
            <table>
                <tr><td>
                    <div class="link"><a href="home.php">Home</a></div>
                </td></tr>
                <tr><td>
                <h3>Welcome to the Store <?php echo $_SESSION['username']?>!</h3>    
                </td></tr>
            </table>
        </div>
        <pre>
        <?php
        include 'DatabaseConnector.php';
        $dbconnector = new DatabaseConnector();
        $dbconnector->open();
        $all_items = $dbconnector->get_all_Items();
        
        
        
        
        //Shows all Items.
        var_dump($all_items);
        // put your code here
        ?>
        </pre>
    </body>
</html>

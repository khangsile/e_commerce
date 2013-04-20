<?php
session_start();
if ($_SESSION['username'] == NULL){
    header("location: index.php");
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
        <div id="navbar">
            <table>
            <tr><td>
                    <div class="link"> <a href="signout.php">Sign Out</a></div>
            </td></tr>
            </table>
            <table>
            <td><div class="link" ><a href="home.php">Home</a></div></td>
            <td><div class="link"><a href="shop.php">Shop</a></div></td>
            <td><div class="link"><a href="account.php">Account</a></div></td>
            <td><div class="link"><a href="inventory.php">Inventory</a></div></td>
            <td><div class="link"><a href="analytics.php">Analytics</a></div></td>
            <td><div class="link"><a href="promotions.php">Promotions</a></div></td>
            </table>
        </div>
    
<pre>
<?php

    include 'DatabaseConnector.php';
    $dbconnector = new DatabaseConnector();
    $dbconnector->open();

    $items = $dbconnector->get_all_Users();
    var_dump($items);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</pre>
        
    </body>
</html>

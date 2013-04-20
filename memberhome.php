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
                        <h3>Welcome Store Member: <?php echo $_SESSION['username']?>!</h3>
                <td></tr>
            </table>
            <table>
            <tr><td>
                <div class="link"> <a href="signout.php">Sign Out</a></div>
            </td></tr>
            </table>
            <table>
                <td><div class="link" ><a href="login.php">Home</a></div></td>
                <td><div class="link"><a href="shop.php">Shop</a></div></td>
                <td><div class="link"><a href="account.php">Account</a></div></td>
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

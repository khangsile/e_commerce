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
            </td></tr></table>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>

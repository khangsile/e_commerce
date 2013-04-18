<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <pre>
        <?php
        
        include 'DatabaseConnector.php';
        $dbconnector = new DatabaseConnector();
        $dbconnector->open();
        
        $items = $dbconnector->get_all_Items();
        //var_dump($items);
        
        ?>
        </pre>
        <div id="header">
            <h1>E-Commerce</h1>            
        </div>
        
        <form name="login" method="post" action="login.php">
            <div>
                <td>Username :</td>
                <td><input name="username" type="text" id="username"></input></td>
            </div>
        
            <div>
                <td>Password :</td>
                <td><input name="password" type="text" id="password"></input></td>
            </div>
            
            <div>
                <input name="submit" type="submit" id="submit"></input>
            </div>
        </form>
        <form name="new_registration" method="post" action="registration.php">
            <div>
                <tr><td>
                        <div class="link"><a href="registration.php">New User Registration</a></div>
                </td></tr>
                
            </div>
        </form>
        
        
    </body>
</html>

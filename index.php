<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        ?>
        <div id="header">
            <h1>E-Commerce</h1>            
        </div>
        
        <div id="navbar">
            <td><div class="link"><a href="shop.php">Shop</a></div></td>
            <td><div class="link"><a href="account.php">Account</a></div></td>
            <td><div class="link"><a href="inventory.php">Inventory</a></div></td>
            <td><div class="link"><a href="analytics.php">Analytics</a></div></td>
            <td><div class="link"><a href="promotions.php">Promotions</a></div></td>
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
        
        
        
    </body>
</html>

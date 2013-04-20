<?php
session_start();
if ($_SESSION['username'] == NULL){
    header("location: index.php");
}
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
                    <div class="link"> <a href="signout.php">Sign Out</a></div>
            </td></tr>
            </table>
            <table>
            <td><div class="link" ><a href="login.php">Home</a></div></td>
            </table>
            <table>
                <tr><td>
                    <h3>Inventory Management. </h3>
                    <h3> Manager: <?php echo $_SESSION['username']?>!</h3>
                </td></tr>
                <tr><td>
                    <h4>Inventory Update:</h4>            
                </td></tr>
            </table>
            <form name="login" method="post" action="inventoryupdate.php">
                <table>
                    <tr>
                    <td>Item ID :</td>
                    <td><input name="item_id" type="text" id="item_id"></input></td>
                    </tr>
                    <tr>
                    <td>Updated Quantity :</td>
                    <td><input name="new_count" type="text" id="new_count"></input></td>
                    </tr>
                    <tr>
                    <td><input name="submit" type="submit" id="submit"></input></td>
                    </tr>
                </table>
            </form>
        </div>
        <pre>
        <?php
        include 'DatabaseConnector.php';
        $dbconnector = new DatabaseConnector();
        $dbconnector->open();
        $all_items = $dbconnector->get_all_Items();
        
        for($counter = 0; $counter< count($all_items); $counter++) {
            $item_title = $all_items[$counter]["title"];
            $item_id = $all_items[$counter]["item_id"];
            $item_description = $all_items[$counter]["item_description"];
            $item_price = $all_items[$counter]["item_price"];
            $item_count = $all_items[$counter]["item_count"];
            
            echo '<br/>';
            echo 'Item: '; echo $item_title; echo'<br/>';
            echo 'Item ID: '; echo $item_id; echo'<br/>';
            echo 'Item Description: '; echo $item_description; echo '<br/>';
            echo 'Item Price: '; echo $item_price; echo'<br/>';
            echo 'Item Count: '; echo $item_count; echo'<br/>';
        }
        
        ?>
        </pre>
        
        
        <pre>
        <?php
        var_dump($all_items);
        
        ?>
        </pre>
    </body>
</html>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

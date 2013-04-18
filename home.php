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
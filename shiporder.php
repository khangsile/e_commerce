<?php
    include "DatabaseConnector.php";
    
    $order_id = $_GET['order'];

    $dbconnector = new DatabaseConnector();
    $dbconnector->open();
    
    $dbconnector->ship_order($order_id);

    $dbconnector->close();
    
    header("location: shipping.php");
?>

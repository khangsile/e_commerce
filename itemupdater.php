<?php
session_start();
include "DatabaseConnector.php";

$dbconnector = new DatabaseConnector();
$dbconnector->open();

$item_count = $_POST['item_count'];
$item_id = $_GET["i"]; 

if(($item_count < 0)||($item_id == NULL)||($item_count == NULL)){
    header("location: inventory.php");
}
else {
    $dbconnector->set_item_count($item_id, $item_count);
    header("location: inventory.php");
}
//LOG INVENTORY UPDATES


?>

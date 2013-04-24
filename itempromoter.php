<?php
session_start();
include "DatabaseConnector.php";

$dbconnector = new DatabaseConnector();
$dbconnector->open();

$item_price = $_POST['item_price'];
$promo_description = $_POST['promo_description'];
$item_id = $_GET["i"]; 
if(($item_price < 0)){
    header("location: promotions.php");
}
else {
    $dbconnector->set_item_promo($item_id, $item_price, $promo_description);
    header("location: promotions.php");
}
//LOG INVENTORY UPDATES


?>

<?php
session_start();
include "DatabaseConnector.php";

$dbconnector = new DatabaseConnector();
$dbconnector->open();

$promo_id = $_GET["i"]; 
$dbconnector->remove_promo($promo_id);
header("location: promotions.php");

//LOG INVENTORY UPDATES


?>


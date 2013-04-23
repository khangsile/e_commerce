<?php
session_start();
include "DatabaseConnector.php";

$dbconnector = new DatabaseConnector();
$dbconnector->open();

$new_item_title = $_POST['new_item_title'];
$new_item_price = $_POST['new_item_price'];
$new_item_count = $_POST['new_item_count'];
$new_item_description = $_POST['new_item_description'];

$dbconnector->add_new_item($new_item_title, $new_item_price, $new_item_description, $new_item_count);

header("location: inventory.php");
?>

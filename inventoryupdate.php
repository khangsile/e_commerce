<?php    
include "DatabaseConnector.php";

$dbconnector = new DatabaseConnector();
$dbconnector->open();


$item_id = $_POST['item_id'];
$new_count = $_POST['new_count'];

if(($new_count < 0)||($item_id == NULL)||($new_count == NULL)){
    header("location: inventory.php");
}
else {
    $dbconnector->set_item_count($item_id, $new_count);
    header("location: inventory.php");
}
// LOG DATA OF UPDATES??
?>
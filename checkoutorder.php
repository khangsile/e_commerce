<?php
    include "DatabaseConnector.php";

    session_start();
    
    $valid = true;
    
    $shopping_cart = $_SESSION['shopping_cart'];
    
    if (count($shopping_cart)<1) {
        header("location: shoppingcart.php");
        $valid = false;
    }
    
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    
    if (empty($address) || empty($city) || empty($state) || empty($zip)) {
        header("location: home.php");
        $valid = false;
    }
    
    if (strlen($zip) != 5) {
        header("location: checkout.php");
        $valid = false;
    }
    
    $full_address = $address . $city . $state . $zip;
    
    $credit_card = $_POST['credit_card'];
    
    if (strlen($credit_card) != 16) {
        header("location: checkout.php");
        $valid = false;
    }
    
    $dbconnector = new DatabaseConnector();
    $dbconnector->open();
    
    for($i=0; $i<count($_SESSION['shopping_cart']); $i++) {
        $item_id = $_SESSION['shopping_cart'][$i]['item_id'];
        
        $available_amt = $dbconnector->get_item_count($item_id);
        
        if ($_SESSION['shopping_cart'][$i]['item_count']>$available_amt) {
            $valid = false;
            $_SESSION['shopping_cart'][$i]['item_count'] = $available_amt;
        }
    }
    
    $dbconnector->close();
    
    if ($valid) {
        $dbconnector->open();
        
        $username = $_SESSION['username'];
        $user_id = $dbconnector->get_user_id($username);
    
        if($dbconnector->add_new_order($full_address, $credit_card, $user_id, $_SESSION['shopping_cart']))
           $_SESSION['shopping_cart'] = array();
        
        $dbconnector->close();
        
     }
     
     header("location: shoppingcart.php");

    
?>

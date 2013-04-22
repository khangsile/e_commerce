<?php
    session_start();
    
    if ($_SESSION['username'] == NULL){
        header("location: index.php");
    }

    $item_id = $_GET["itemid"];

    if ($_SESSION['shopping_cart'] == NULL)
        $_SESSION['shopping_cart'] = array();
    
    $_SESSION['shopping_cart'][] = $item_id;
    
    header("location: items.php");
    
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

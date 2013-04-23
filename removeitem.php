<?php
    session_start();
    
    if ($_SESSION['username'] == NULL){
        header("location: index.php");
    }

    $index = $_GET["index"];

    $shopping_cart = $_SESSION['shopping_cart'];
    unset($shopping_cart[$index]);
    $_SESSION['shopping_cart'] = array_values($shopping_cart);
    
    header("location: shoppingcart.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

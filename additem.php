<?php
    session_start();
    
    if ($_SESSION['username'] == NULL){
        header("location: index.php");
    }

    $item_id = $_GET["itemid"];
    $item_count = $_GET['item_count'];

    if ($_SESSION['shopping_cart'] == NULL)
        $_SESSION['shopping_cart'] = array();
    
    $item = array();
    
    $key = in_array1($_SESSION['shopping_cart'], $item_id);
    
    if ($item_count > 0) {
        if (is_int($key)) {
        
            $_SESSION['shopping_cart'][$key]['item_count']+= $item_count;
        
        } else {
        
            $item['item_id'] = $item_id;
            $item['item_count'] = $item_count;
    
            $_SESSION['shopping_cart'][] = $item;
        }
    }
    header("location: shoppingcart.php");
    

    function in_array1($products, $needle) {
        foreach($products as $key => $product) {
                        
            if ( $product['item_id'] == $needle )
                return $key;
        }
            
    return false;
    }
?>

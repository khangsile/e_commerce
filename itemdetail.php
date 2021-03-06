<?php
session_start();
if ($_SESSION['username'] == NULL){
    header("location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Food</title>
<meta name="keywords" content="station shop, product detail, web design theme, free website template, templatemo" />
<meta name="description" content="Station Shop Theme, Product Detail, free template provided by templatemo.com" />
<link href="templatemo_352_station_shop/css/templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="templatemo_352_station_shop/css/ddsmoothmenu.css" />

<script type="text/javascript" src="templatemo_352_station_shop/js/jquery.min.js"></script>
<script type="text/javascript" src="templatemo_352_station_shop/js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<link rel="stylesheet" type="text/css" media="all" href="templatemo_352_station_shop/css/jquery.dualSlider.0.2.css" />

<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.timers-1.2.js" type="text/javascript"></script>

</head>

<body>

<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	
    	<div id="site_title">
        	<h1><a href="home.php">Food</a></h1>
        </div>
        
        <div id="header_right">
            <a href="account.php">My Account</a> | <a href="orders.php">Orders</a> | <a href="shoppingcart.php">Checkout</a> | <a href="signout.php">Log Out</a>
		</div>
        
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menu">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <?php
                
                include "DatabaseConnector.php";
                
                $dbconnector = new DatabaseConnector();
                $dbconnector->open();
                $user = $dbconnector->get_permissions_from_type($_SESSION['user_type']);
                
                echo'<li><a href="home.php" >Home</a></li>';
                echo'<li><a href="items.php" class="selected">Products</a></li>';
                echo'<li><a href="shoppingcart.php">Checkout</a></li>';
                
                if ($user[0]["shipping"]==1)  {
                    echo"<li><a href=\"shipping.php\">Shipping</a></li>";
                }
                
                if($user[0]["inventory"]==1) {
                    echo'<li><a href="inventory.php">Inventory</a></li>';
                }
                if($user[0]["statistics"]==1) {
                    echo'<li><a href="analytics.php">Analytics</a></li>';
                }
                if($user[0]["promotions"]==1) {
                    echo'<li><a href="promotions.php">Promotions</a></li>';
                }
                
                
                ?>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="menu_second_bar">
        	<div id="top_shopping_cart">
            	Shopping Cart: <strong>
                    <?php
                        echo count($_SESSION['shopping_cart']);
                    ?>
                    Products</strong> ( <a href="shoppingcart.php">Show Cart</a> )
            </div>
        	
            <div class="cleaner"></div>
    	</div>
    </div> <!-- END of templatemo_menu -->
    
    <div id="templatemo_main">
   		<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Categories</h3>   
                <div class="content"> 
                    <ul class="sidebar_list">
                    	<li class="first"><a href="#">All</a></li>
                        <li><a href="#">Outdoor</a></li>
                        <li><a href="#">Fine Dining</a></li>
                        <li><a href="#">Tailgating</a></li>
                        <li><a href="#">Graduation</a></li>
                        <li><a href="#">Birthday</a></li>
                        <li><a href="#">Date</a></li>
                        <li class="last"><a href="#">Party</a></li>
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3>Promotions</h3>   
                <div class="content"> 
                    <?php
                    
                    $dbconnector->open();
                    
                    $LIMIT = 4;
                    $promotions = $dbconnector->get_promotions($LIMIT);
                    
                    for($i=0;$i<count($promotions);$i++) {
                        
                        $item_id = $promotions[$i]['item_id'];
                        $item_info = $dbconnector->get_item_info($item_id);
                            
                        echo "<div class=\"bs_box\">";
                            
                        $promo_title = $promotions[$i]['promotion_title'];
                        echo "<div><h4 style='color: white'>$promo_title</h4></div>";
                        
                        $item_title = $item_info['title'];
                        echo "<h4><a href='itemdetail.php?itemid=$item_id'>$item_title</a></h4>";
                        
                        $promo_price = $promotions[$i]['promo_price'];
                        echo "<p class='price'>$$promo_price</p>";
                        
                        echo "<div class='cleaner'></div>";
                        echo "</div>";
                         
                    }
                    
                    $dbconnector->close();
                ?>  
                </div>
            </div>
        </div>
        <div id="content" class="float_r">
        	
            <?php
                
                $dbconnector = new DatabaseConnector();
                $dbconnector->open();
                
                $item_id = $_GET["itemid"];
                
                $item_info = $dbconnector->get_item_info($item_id);
                $dbconnector->close();
                
                $item_name = $item_info['title'];
                
                echo "<h1>$item_name</h1>";
            ?>
            
            <!--<div class="content_half float_l">
        	<a  rel="lightbox[portfolio]" href="images/product/10_l.jpg"><img src="images/product/10.jpg" alt="Image 01" /></a>
            </div> -->
            <div class="content_half float_r">
				<table>
                    <tr>
                        <td height="30" width="160">Price:</td>
                        <td>
                            <?php 
                                $item_price = $item_info['item_price'];
                                echo "$$item_price"; 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td height="30">Availability:</td>
                        <td>
                            <?php
                                $dbconnector->open();
                                
                                $item_count = $dbconnector->get_item_count($item_id);
                                if ($item_count > 0)
                                    echo "$item_count In Stock";
                                else 
                                    echo "Out of Stock";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td height="30">Model:</td>
                        <td>Product 14</td>
                    </tr>
                    <tr>
                        <td height="30">Manufacturer:</td>
                        <td>Apple</td>
                    </tr>
                    <form name="toCart" method="get" action="additem.php">
                    <tr><td height="30">Quantity</td><td><input name="item_count"type="number" value="0" style="width: 30px; text-align: right" min="0" <?php
                        echo "max='$item_count'"; ?>/></td></tr>
                        <input type="hidden" name="itemid" value= <?php echo "\"$item_id\"" ?> />
                        <tr>
                            <td height="30"></td><td><input type="submit" value="Add to Cart"/></td>
                        </tr>
                        
                    </form>
                </table>
                <div class="cleaner h20"></div>
                <a href=<?php echo "\"additem.php?itemid=$item_id\""; ?> class="add_to_cart">Add to Cart</a>
			</div>
            <div class="cleaner h30"></div>
            
            <h5>Product Description</h5>
            <p>
                <?php 
                    $item_description = $item_info['item_description'];
                    echo "$item_description";
                ?>
            </p>	
            
            <div class="cleaner h50"></div>
            
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p>
			<a href="index.html">Home</a> | <a href="products.html">Products</a> | <a href="about.html">About</a> | <a href="faqs.html">FAQs</a> | <a href="checkout.html">Checkout</a> | <a href="contact.html">Contact</a>
		</p>

    	Copyright © 2048 <a href="#">Your Company Name</a> | Designed by <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a>
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->

</body>
</html>

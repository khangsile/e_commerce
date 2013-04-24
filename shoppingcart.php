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
<meta name="keywords" content="station shop, cart, free templates, website templates, CSS, HTML" />
<meta name="description" content="Station Shop, Shopping Cart, free CSS template by templatemo.com" />
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

<script src="templatemo_352_station_shop/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="templatemo_352_station_shop/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="templatemo_352_station_shop/js/jquery.timers-1.2.js" type="text/javascript"></script>

</head>

<body>

<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	
    	<div id="site_title">
        	<h1><a href="http://www.templatemo.com">Food
        </div>
        
        <div id="header_right">
	        <a href="account.php">My Account</a> | <a href="#">Checkout</a> | <a href="signout.php">Log Out</a>
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
                
                echo'<li><a href="home.php">Home</a></li>';
                echo'<li><a href="items.php">Products</a></li>';
                echo'<li><a href="shoppingcart.php" class="selected">Checkout</a></li>';
                
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
                
                $dbconnector->close();
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
                    Products</strong> ( <a href="#">Show Cart</a> )
            </div>
        	<div id="templatemo_search">
                <form action="#" method="get">
                  <input type="text" value="Search" name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
                  <input type="submit" name="Search" value=" Search " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
                </form>
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
            	<h3>Best Sellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="Image 01" /></a>
                        <h4><a href="#">Donec nunc nisl</a></h4>
                        <p class="price">$10</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="Image 02" /></a>
                        <h4><a href="#">Aenean eu tellus</a></h4>
                        <p class="price">$12</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="Image 03" /></a>
                        <h4><a href="#">Phasellus ut dui</a></h4>
                        <p class="price">$20</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="Image 04" /></a>
                        <h4><a href="#">Vestibulum ante</a></h4>
                        <p class="price">$16</p>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="float_r">
        	<h1>Shopping Cart</h1>
        	<table width="680px" cellspacing="0" cellpadding="5">
                   	  	<tr bgcolor="#ddd">
                        	<th width="220" align="left">Title </th> 
                        	<th width="180" align="left">Description </th> 
                       	  	<th width="100" align="center">Quantity </th> 
                        	<th width="60" align="right">Price </th> 
                        	<th width="60" align="right">Total </th> 
                        	<th width="90"> </th>
                      	</tr>
                            <?php
                            
                                $items = $_SESSION['shopping_cart'];
                                
                                $dbconnector = new DatabaseConnector();
                                $dbconnector->open();
                                
                                $total = 0;
                                
                                for($i=0;$i<count($items);$i++) {
                                    $item_info = $dbconnector->get_item_info($items[$i]['item_id']);
                                    echo "<tr>";
                                    
                                    $item_id = $items[$i]['item_id'];
                                    $item_title = $item_info['title'];
                                    echo "<td><a href='itemdetail.php?itemid=$item_id&item_count=1'>$item_title</a></td>";
                                    
                                    $item_description = $item_info['item_description'];
                                    echo "<td>$item_description</td>";
                                    
                                    $item_count = $items[$i]['item_count'];
                                    echo "<td align=\"center\">$item_count</td>";
                                    
                                    $item_price = $item_info['item_price'];
                                    $total += $item_price;
                                    echo "<td align=\"right\">$$item_price </td>";
                                    echo "<td align=\"right\">$".$item_price*$item_count."</td>";
                                   
                                    echo "<td align=\"center\"><a href=\"removeitem.php?index=$i\">Remove</a></td></tr>";
                                }
                                
                                $dbconnector->close();
                            ?>
                            <tr>
                        	<td colspan="3" align="right"  height="30px">Have you modified your basket? Please click here to <a href="shoppingcart.php"><strong>Update</strong></a>&nbsp;&nbsp;
                            <td align="right" style="background:#ddd; font-weight:bold"> Total </td>
                            <td align="right" style="background:#ddd; font-weight:bold">$<?php echo $total; ?></td>
                            <td style="background:#ddd; font-weight:bold"> </td>
						</tr>
					</table>
                    <div style="float:right; width: 215px; margin-top: 20px;">
                    
					<p><a href="checkout.php">Proceed to checkout</a></p>
                    <p><a href="items.php">Continue shopping</a></p>
                    	
                    </div>
            
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

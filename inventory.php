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
	        <a href="account.php">My Account</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> | <a href="signout.php">Log Out</a>
		</div>
        
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menu">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="items.php">Products</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="faqs.html">FAQs</a></li>
                <li><a href="checkout.html">Checkout</a></li>
                <li><a href="contact.html">Contact</a></li>
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
        	<h1>Inventory Management</h1>
        	<table width="680px" cellspacing="0" cellpadding="5">
                   	  	<tr bgcolor="#ddd">
                        	<th width="220" align="left">Title </th> 
                        	<th width="180" align="left">Description </th> 
                       	  	<th width="100" align="center">Quantity </th> 
                        	<th width="60" align="right">Price </th> 
                        	<th width="60" align="right">Update</th> 
                        	<th width="90"> </th>
                      	</tr>
                            <?php
                                include "DatabaseConnector.php";                                
                                $dbconnector = new DatabaseConnector();
                                $dbconnector->open();
                                $items = $dbconnector->get_all_Items();
                                for($i=0;$i<count($items);$i++) {
                                    echo "<tr>";
                                    
                                    $item_title = $items[$i]["title"];
                                    echo "<td>$item_title</td>";
                                    
                                    $item_description = $items[$i]["item_description"];
                                    echo "<td>$item_description</td>";
                                    
                                    $item_count = $items[$i]["item_count"];
                                    echo "<td align=\"center\">$item_count</td>";
                                    
                                    $item_price = $items[$i]["item_price"];
                                    echo "<td align=\"right\">$$item_price </td>";
                                    
                                    $item_update_id = $items[$i]["item_id"];
                                    echo "<td align=\"center\"><a href=\"itemupdatepage.php?i=$item_update_id\">Update</a></td></tr>";
                                   
                                }
                                echo "<tr><td align=\"right\" colspan=\"5\"><a href=\"newitemadd.php\">New Item</a></td></tr>";
                                $dbconnector->close();
                            ?>
                            </tr>
                    </table>                    	
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


<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div>
            <table>
            <tr><td>
                    <div class="link"> <a href="signout.php">Sign Out</a></div>
            </td></tr>
            </table>
            <table>
            <td><div class="link" ><a href="login.php">Home</a></div></td>
            </table>
            <table>
                <tr><td>
                    <h3>Inventory Management. </h3>
                    <h3> Manager: <?php echo $_SESSION['username']?>!</h3>
                </td></tr>
                <tr><td>
                    <h4>Inventory Update:</h4>            
                </td></tr>
            </table>
            <form name="login" method="post" action="inventoryupdate.php">
                <table>
                    <tr>
                    <td>Item ID :</td>
                    <td><input name="item_id" type="text" id="item_id"></input></td>
                    </tr>
                    <tr>
                    <td>Updated Quantity :</td>
                    <td><input name="new_count" type="text" id="new_count"></input></td>
                    </tr>
                    <tr>
                    <td><input name="submit" type="submit" id="submit"></input></td>
                    </tr>
                </table>
            </form>
        </div>
        <pre>
        <?php
        include 'DatabaseConnector.php';
        $dbconnector = new DatabaseConnector();
        $dbconnector->open();
        $all_items = $dbconnector->get_all_Items();
        
        for($counter = 0; $counter< count($all_items); $counter++) {
            $item_title = $all_items[$counter]["title"];
            $item_id = $all_items[$counter]["item_id"];
            $item_description = $all_items[$counter]["item_description"];
            $item_price = $all_items[$counter]["item_price"];
            $item_count = $all_items[$counter]["item_count"];
            
            echo '<br/>';
            echo 'Item: '; echo $item_title; echo'<br/>';
            echo 'Item ID: '; echo $item_id; echo'<br/>';
            echo 'Item Description: '; echo $item_description; echo '<br/>';
            echo 'Item Price: '; echo $item_price; echo'<br/>';
            echo 'Item Count: '; echo $item_count; echo'<br/>';
        }
        
        ?>
        </pre>
    </body>
</html>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

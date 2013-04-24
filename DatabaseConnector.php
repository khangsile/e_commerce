<?php
class DatabaseConnector {
    private $dbconn = null;
    
    //Open the database
    public function open() {
        $host = "mysql.cs.uky.edu";    
        $username = "jchett2";
        $password = "asdf1234";
        $database = "jchett2";
        
        $this->dbconn = new mysqli($host, $username, $password, $database) or die("Unable to connect to host");
    }
    
    public function close() {
        if ($this->dbconn) {
            mysqli_close($this->dbconn);
            $this->dbconn = null;
        } else {
            echo "No connection to database";
        }
    }
    
    public function check_register($username, $email) {
        $query = "SELECT * FROM users WHERE (user_name = '$username' OR user_email = '$email')";
        
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
       
        return empty($result_array);
    }
    
    public function login($username, $password) {
        //removed sql protector for now.
        $username = ($username);
        $password = ($password);
        
        $results = $this->login_query($username, $password);
        
        return (count($results)==1);
        
        if (count($results)==1)
            return true;
        
        return false;
    }
    
    public function get_user($username){
        $query = "Select * FROM users WHERE user_name ='$username'";
        $result = $this->dbconn->query($query);
        $results = $this->results_to_array($result);
        return $results;
    }
    
    public function get_all_Users() {
        $results = $this->get_all_users_query();
        
        //additional work
        
        return $results;
    }
    
    public function get_permissions_from_type($usertype) {
        //$usertype = $this->sql_protect($usertype);

        $permissions_array = $this->get_permissions_query($usertype);
        return $permissions_array;
    }
    
    public function add_new_item($new_item_title, $new_item_price, $new_item_description, $new_item_count) {
        $this->add_new_item_query($new_item_title, $new_item_price, $new_item_description, $new_item_count);
    }
    
    private function add_new_item_query($new_item_title, $new_item_price, $new_item_description, $new_item_count) {
        $query = "INSERT INTO items (title, item_description, item_price)
                         VALUES('$new_item_title', '$new_item_description', '$new_item_price')";
        
        $this->dbconn->query($query);
        $last_id = $this->dbconn->insert_id;
        
        $query = "INSERT INTO inventory (item_id, item_count)
                         VALUES('$last_id', '$new_item_count')"; 
        
        $this->dbconn->query($query);
        
        return TRUE;
    }
    
    public function get_promotions($limit) {
        return $this->get_promotions_query($limit);
    }
    
    public function add_new_order($address, $credit_card, $user_id, $items) {
        if (empty($address) || empty($credit_card) || empty($user_id) || empty($items)) 
            return false;
        
        if (!is_array($items))
            return false;
        
        $this->add_new_order_query($address, $credit_card, $user_id, $items);
        
        return true;
    }
    
    private function add_new_order_query($address, $credit_card, $user_id, $items) {
        
        $query = "INSERT INTO Orders (ordered_date, credit_card, address)
                    VALUES (NOW(), '$credit_card', '$address')";
        
        $this->dbconn->query($query);
        $id = $this->dbconn->insert_id;
        
        $query = "INSERT INTO purchases (order_id, user_id) 
                    VALUES ('$id', '$user_id')";
        $this->dbconn->query($query);
        
        for($i=0; $i<count($items); $i++) {
            
            $itemid = $items[$i]['item_id'];
            $item_count = $items[$i]['item_count'];
            $query = "INSERT INTO contains (order_link, item_link, item_count)
                        VALUES('$id', '$itemid', '$item_count')";
            $this->dbconn->query($query);
            
            $current_count = $this->get_item_count($itemid);
            $new_count = $current_count - $item_count;
            
            if ($new_count<0)
                $new_count=0;
            
            $this->set_item_count($itemid, $new_count);
        }
        
    }
    
    //GET ITEM COUNT
    public function get_item_count($item_id) {
        return $this->get_item_count_query($item_id);
    }
    
    private function get_item_count_query($item_id) { 
        $query = "SELECT item_count FROM inventory WHERE item_id='$item_id'";
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        return $result_array[0]["item_count"];
    }
    
    //SET ITEM PROMO
    public function set_item_promo($item_id, $item_price, $promo_description) {
        return $this->set_item_promo_query($item_id, $item_price, $promo_description);
    }
    
    private function set_item_promo_query($item_id, $item_price, $promo_description) { 
        $query = "INSERT INTO promotions (promotion_title, promo_price, item_id)
                         VALUE ('$promo_description', $item_price, '$item_id')";
        $this->dbconn->query($query);
    }
    
    public function get_items_from_order($order_id) {
        
        $items = $this->get_items_from_order_query($order_id);
        
        return $items;
    }
    
    public function get_item_info($item_id) {
        
        //$item_id = $this->sql_protect($item_id);
        
        return $this->get_item_info_query($item_id);
    }
    
    public function get_orders($date) {
     
        return $this->get_orders_query($date);
    }
    
    public function get_unshipped_orders($date) {
        
        return $this->get_unshipped_orders_query($date);
    }
    
    public function get_user_id($username) {
        
        $result = $this->get_user_id_query($username);
        
        return $result[0]['user_id'];
    }
    
    public function get_user_from_order($order_id) {
        $result = $this->get_user_from_order_query($order_id);
        
        return $result['user_id'];
    }
    
    public function get_user_orders($user_id) {
        $purchases = $this->get_user_purchases_query($user_id);
        $orders = array();
        
        for($i=count($purchases)-1; $i>=0;$i--) {
            $orders[] = $this->get_order_query($purchases[$i]['order_id']);
        }
        
        return $orders;
    }
    
    public function register($username, $password, $email, $user_type) {
        $query = "INSERT INTO users(user_name, user_pass, user_type, user_email)
                  VALUES ('$username', '$password', '$user_type', '$email')";
       
        $this->dbconn->query($query);
    }
    
    //SET INVENTORY COUNTS
    public function set_item_count($item_id, $new_count) {
        $this->set_item_count_query($item_id, $new_count);
        return;
    }
    
    public function ship_order($order_id) {        
        $query = "UPDATE Orders SET Orders.shipped_date = NOW() where idOrders = '$order_id' AND shipped_date IS NULL";
        
        $this->dbconn->query($query);
    }
    
    //***************************QUERIES****************************************
    
    private function get_items_from_order_query($order_id) {
        if (!$order_id) 
            return null;
        
        $query = "SELECT c.item_link, c.item_count FROM contains c WHERE order_link = '$order_id'";
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        
        return $result_array;
    }
    
    private function get_user_from_order_query($order_id) {
        if (!$order_id)
            return null;
        
        $query = "SELECT user_id FROM purchases WHERE order_id = '$order_id'";
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        
        return $result_array[0];
    }
    
    private function get_user_purchases_query($user_id) {
        if (!$user_id)
            return null;
        
        $query = "SELECT * FROM purchases WHERE user_id='$user_id'";
        
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        
        return $result_array;
    }
    
    private function get_order_query($order_id) {
        if (!$order_id)
            return null;
        
        $query = "SELECT * FROM Orders WHERE idOrders = '$order_id'";
        
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        
        return $result_array[0];
    }
    
    //null if you want all unshipped
    private function get_unshipped_orders_query($date) {
        $query = "";
        
        if ($date == null)
            $query = "SELECT * FROM Orders WHERE shipped_date IS NULL";
        else
            $query = "SELECT * FROM Orders WHERE shipped_date IS NULL AND ordered_date>'$date'";
        
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        
        return $result_array;
    }
    //null if you want all orders
    private function get_orders_query($date) {
        $query = "";
        
        if ($date == null)
            $query = "SELECT * FROM Orders";
        else
            $query = "SELECT * FROM Orders WHERE ordered_date> '$date'";
                        
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        
        return $result_array;
    }
    
    private function get_item_info_query($item_id) {
        $query = "SELECT * FROM items WHERE item_id ='$item_id'";
        
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        
        return $result_array[0];
    }
    
    private function get_permissions_query($usertype) {
        $query = "SELECT * FROM user_types WHERE user_type = '$usertype'";
        
        $result = $this->dbconn->query($query);
        $result_array = $this->results_to_array($result);
        
        if (count($result_array)==1) {
            return $result_array;
        } else {
            echo "ERROR";
            return null;
        }
    }
    
    private function get_promotions_query($limit) {
        $query = "SELECT p.promotion_title, p.promo_price, p.item_id FROM promotions p LIMIT $limit";
        
        $result = $this->dbconn->query($query);
        
        return $this->results_to_array($result);
    }
    
    private function get_all_users_query() {
        $query = "SELECT * FROM users";
        $result = $this->dbconn->query($query);
        $rows = $this->results_to_array($result);
        
        return $rows;
    }
    
    private function get_user_id_query($username) {
        $query = "SELECT user_id FROM users WHERE user_name = '$username'";
        
        $result = $this->dbconn->query($query);
        $rows = $this->results_to_array($result);
        
        return $rows;
    }
    
    //GET PERMISSIONS
    public function get_user_permissions($username) {
        return($this->get_user_permissions_query($username));
    }
    
    private function get_user_permissions_query($username) {
        $query2 = "SELECT * FROM user_types
                   JOIN (users) ON (user_types.user_type = users.user_type)
                   WHERE user_name='$username'";
        $result = $this->dbconn->query($query2);
        $rows = array();
        $rows = $this->results_to_array($result);
        
    }
    
    //GET PROMO TITLE
    public function get_promo($item_id) {
        return $this->get_promo_title_query($item_id);
    }
    private function get_promo_title_query($item_id) {
        $query2 = "SELECT * FROM promotions
                   WHERE item_id = '$item_id'";
        $result = $this->dbconn->query($query2);
        $rows = array();
        $rows = $this->results_to_array($result);
        return $rows;
    }
    
     public function remove_promo($promo_id) {
        $this->remove_promo_query($promo_id);
        return TRUE;
    }
    private function remove_promo_query($promo_id) {
        $query2 = "DELETE FROM promotions
                   WHERE promo_code = $promo_id";
        $this->dbconn->query($query2);
        return TRUE;
    }
    
    //GET SHIPPED ORDERS
    public function get_shipped_orders() {
        return $this->get_shipped_orders_query();
    }
    private function get_shipped_orders_query() {
        $query = "SELECT * FROM Orders o 
                  WHERE o.shipped_date IS NOT NULL";
        $result = $this->dbconn->query($query);
        $results = $this->results_to_array($result);
        return $results;
    }
    
    //GET ITEMS SOLD
    public function get_items_sold() {
        return $this->get_items_sold_query();
    }
    private function get_items_sold_query() {
        $query = "SELECT * FROM contains";
        $result = $this->dbconn->query($query);
        $results = $this->results_to_array($result);
        return $results;
    }
    //GET USER TYPE
    public function get_user_type ($username) {
        return($this->get_user_type_query($username));
    }
    
    private function set_item_count_query($item_id, $new_count) {
        $query = "UPDATE inventory SET inventory.item_count = '$new_count' WHERE inventory.item_id = '$item_id'";
        $this->dbconn->query($query);
    }
     
    //GET ALL ITEMS
    public function get_all_Items() {
        $results = $this->get_all_items_query();
                
        return $results;
    }
    
    private function get_user_type_query($username) {
        $query2 = "SELECT * FROM users WHERE user_name='$username'";
        $result = $this->dbconn->query($query2);
        $rows = array();
        $rows = $this->results_to_array($result);
        
        return($rows[0]["user_type"]);
    }
    
    private function get_all_items_query() {
        $query = "SELECT * FROM items 
                    JOIN (inventory) ON (items.item_id = inventory.item_id)";
        //LEFT JOIN (promotions) ON (items.item_id = promotions.item_id)";
                    
        $result = $this->dbconn->query($query);
        $rows = array();
        $rows = $this->results_to_array($result);
        return $rows;
    }
    
    private function login_query($username, $password) {
        
        $query = "SELECT * FROM users WHERE user_name='$username' and user_pass='$password'";
        $result = $this->dbconn->query($query);  
        if (count($result) > 0){
            $users = $this->results_to_array($result); 
        }
        else{
            $users = NULL; 
        }
    
        return $users;
    }
    
    //*****************************HELPER***************************************
    
    private function results_to_array($input) {
        $row = array();
        while ($row = $input->fetch_assoc()) {
            $results[] = $row;
        }
        
        return $results;
    }
    
    private function sql_protect($input) {
        $input = \stripslashes($input);
        $escaped_input = mysqli_real_escape_string($input);
        
        return $escaped_input;
    }
}

?>

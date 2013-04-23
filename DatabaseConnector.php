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
    
    public function login($username, $password) {
        //removed sql protector for now.
        $username = ($username);
        $password = ($password);
        
        $results = $this->login_query($username, $password);
        
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
    
    public function get_item_info($item_id) {
        
        //$item_id = $this->sql_protect($item_id);
        
        return $this->get_item_info_query($item_id);
    }
    
    private function get_item_info_query($item_id) {
        $query = "SELECT * FROM items WHERE item_id='$item_id'";
        
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
    
    public function check_register($username, $email) {
        $query = "SELECT * FROM users WHERE (user_name = '$username' OR user_email = '$email')";
        $result = $this->dbconn->query($query);
        //var_dump($result);
        $result_array = $this->results_to_array($result);
        //var_dump($result_array);
        if (empty($result_array)) {
            return TRUE;
        }
        else {
            return FALSE;
        }
            
    }
    
    public function register($username, $password, $email, $user_type) {
        $query = "INSERT INTO users(user_name, user_pass, user_type, user_email)
                  VALUES ('$username', '$password', '$user_type', '$email')";
        $this->dbconn->query($query);
        
    }
    
    private function get_all_users_query() {
        $query = "SELECT * FROM users";
        $result = $this->dbconn->query($query);
        $rows = array();
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
    
    //GET USER TYPE
    public function get_user_type ($username) {
        return($this->get_user_type_query($username));
    }
    
    //SET INVENTORY COUNTS
    public function set_item_count($item_id, $new_count) {
        $this->set_item_count_query($item_id, $new_count);
        return;
    }
    private function set_item_count_query($item_id, $new_count) {
        $query = "UPDATE inventory SET inventory.item_count = '$new_count' WHERE inventory.item_id = '$item_id'";
        $this->dbconn->query($query);
    }
    
    
    //GET ALL ITEMS
    public function get_all_Items() {
        $results = $this->get_all_items_query();
        
        //additional work
        
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
        $query = "SELECT * FROM items JOIN (inventory) ON (items.item_id = inventory.item_id)";
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
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

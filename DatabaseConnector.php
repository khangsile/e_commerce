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
    
    public function get_all_Users() {
        $results = $this->get_all_users_query();
        
        //additional work
        
        return $results;
    }
    private function get_all_users_query() {
        $query = "SELECT * FROM users";
        $result = $this->dbconn->query($query);
        $rows = array();
        $rows = $this->results_to_array($result);
        return $rows;
    }
    public function get_all_Items() {
        $results = $this->get_all_items_query();
        
        //additional work
        
        return $results;
    }
    private function get_all_items_query() {
        $query = "SELECT * FROM items";
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
        $escaped_input = mysql_real_escape_string($input);
        
        return $escaped_input;
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

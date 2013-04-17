<?php
class DatabaseConnector {
    private $dbconn = null;
    
    //Open the database
    public function open() {
        $host = "";    
        $username = "";
        $password = "";
        $database = "";
        
        $this->dbconn = mysqli_connect($host, $username, $password, $database) or die("Unable to connect to host");
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
        $username = sql_protect($username);
        $password = sql_protect($password);
        
        $results = login_query($username, $password);
        
        if (count($results)==1)
            return true;
        
        return false;
    }
    
    public function get_all_Items() {
        $results = get_all_items_query();
        
        //additional work
        
        return $results;
    }
    
    private function get_all_items_query() {
        $query = "SELECT * FROM items";
        
        $result = mysqli_query($this->dbconn, $query);
        $results = mysqli_fetch_all($result);
        
        $items = results_to_array($results);
        
        return $items;
    }
    
    private function login_query($username, $password) {
        
        $query = "SELECT * FROM users WHERE name='$username' and password='$password'";

        $result = mysqli_query($this->dbconn, $query);
        $results = mysqli_fetch_all($result);
        
        $users = results_to_array($results);
        
        return $users;
    }
    
    private function results_to_array($input) {
        $results = array();
        
        while ($row = mysqli_fetch_array($input, MYSQL_NUM)) {
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

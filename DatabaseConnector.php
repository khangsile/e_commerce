<?php
class DatabaseConnector {
    private $dbconn = null;
    
    //Open the database
    public function open() {
        $host = "";    
        $username = "";
        $password = "";
        $database = "";
        
        $this->dbconn = \mysqli_connect($host, $username, $password, $database) or die("Unable to connect to host");
    }
    
    public function close() {
        if ($dbconn) {
            mysqli_close($dbconn);
            $dbconn = null;
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
    
    private function login_query($username, $password) {
        $table = "users";
        
        $query = "SELECT * FROM $table WHERE name='$username' and password='$password'";

        $result = mysqli_query($this->dbconn, $query);

        $results = mysqli_fetch_all($result);
        
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

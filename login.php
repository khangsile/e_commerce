<?php
//database information
$host = "";
$user = "";
$pass = "";
$table = "";
$database = "";

$dbconn = mysqli_connect($host, $user, $pass, $database) or die("Unable to connect to host");

//Get username and password from form
$username = $_POST['username'];
$password = $_POST['password'];

$username = stripslashes($username);
$username = mysql_real_escape_string($username);

$password = stripcslashes($password);
$password = mysql_real_escape_string($password);

$query = "SELECT * FROM $table WHERE name='$username' and password='$password'";

$result = mysqli_query($dbconn, $query);

$results = mysqli_fetch_all($result);

//If exists, should only be 1 username/password combination that matches
if (count($results) == 1) {
    //do something
} else {
    echo "Incorrect login information";
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


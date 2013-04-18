<?php
session_start();
include "DatabaseConnector.php";

$dbconnector = new DatabaseConnector();
$dbconnector->open();

//Get username and password from form
$username = $_POST['username'];
$password = $_POST['password'];

$valid = $dbconnector->login($username, $password);

$dbconnector->close();
//if valid username we can continue to the main page
if ($valid) {
    
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    header("location: home.php");
} else {
    echo "Incorrect login information";
    header("location: login_failed.php");
}
?>


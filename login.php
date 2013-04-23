<?php
session_start();
include "DatabaseConnector.php";

$dbconnector = new DatabaseConnector();
$dbconnector->open();

//Get username and password from form
if ($_SESSION['username'] == NULL){
    $username = $_POST['username'];
    $password = $_POST['password'];
}

$valid = $dbconnector->login($username, $password);


//if valid username we can continue to the main page
if ($valid) {
    $user = $dbconnector->get_user($username);
    $_SESSION['username'] = $user[0]["user_name"];
    $_SESSION['password'] = $user[0]["user_pass"];
    $_SESSION['user_type'] = $user[0]["user_type"];
    $_SESSION['shopping_cart'] = array();
    header("location: home.php");
    
} else {
    header("location: login_failed.php");
}
?>


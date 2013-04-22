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
else {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
}
$valid = $dbconnector->login($username, $password);


//if valid username we can continue to the main page
if ($valid) {
    $account_type = $dbconnector->get_user_type($username);
    session_start();
    
    session_register('username');
    session_register('password');
    session_register('user_type');
    session_register('shopping_cart');
    
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['user_type'] = $account_type;
    $_SESSION['shopping_cart'] = array();
    
    if($account_type == 1) {
        header("location: managerhome.php");
    } else if ($account_type == 2) {
        header("location: staffhome.php");
    } else if ($account_type == 3) {
        header("location: home.php");
    }
    
} else {
    header("location: login_failed.php");
}
?>


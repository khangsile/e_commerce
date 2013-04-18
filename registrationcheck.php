<?php

include "DatabaseConnector.php";

$dbconnector = new DatabaseConnector();
$dbconnector->open();

//Get username and password from form
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$user_type = $_POST['user_type'];

echo "username: ".$username."<br/>";
echo "password: ".$password."<br/>";
echo "email:".$email."<br/>";
echo "user_type:".$user_type."<br/>";


if(($username == NULL)|($password == NULL)|($email == NULL)|($user_type == NULL))
{
    $error_message = $error_message." All fields must be filled.<br/>";
}

if($dbconnector->check_register($username, $email)) {
    echo "REGISTERED";
}
else {
    $error_message = $error_message." Username or Email already in use.<br/>";
}

if ($error_message=="")
{
    $dbconnector->register($username, $password, $email, $user_type);
}
 else {
     echo "Error: ".$error_message;
}
?>

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


//CHECKS FOR CORRECTNESS
if(($username == NULL)||($password == NULL)||($email == NULL)||($user_type == NULL))
{
    $error_message = $error_message." All fields must be filled.<br/>";
}
if (!(($user_type == 1)||($user_type == 2)||($user_type += 3))) {
    $error_message = $error_message." Accepted User Types are 1, 2, or 3.<br/>";
}

if($dbconnector->check_register($username, $email)) {
    //do nothing! :)
}
else{
    $error_message = $error_message." Username or Email already in use.<br/>";
}

//if all correct insert else error.
if ($error_message=="")
{
    $dbconnector->register($username, $password, $email, $user_type);
    echo"<br/><h3>Welcome New User!</h3><br/>";
}
 else {
     echo "Error:<br/>".$error_message;
}
?>

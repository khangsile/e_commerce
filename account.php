<?php
session_start();
if ($_SESSION['username'] == NULL){
    header("location: index.php");
}
?>
<html>
    <table>
    <tr><td>
        <div class="link"><a href="login.php">Home</a></div>
    </td></tr>
    </table>
    <h2>User Account Info:</h2>    
</html>

<?php
session_start();
include 'DatabaseConnector.php';
$dbconnector = new DatabaseConnector();
$dbconnector->open();

echo $_SESSION['username'];
$account_details = $dbconnector->get_user($_SESSION['username']);

$username = $account_details[0]["user_name"]; 
$password = $account_details[0]["user_pass"];
$email = $account_details[0]["user_email"];
$user_type = $account_details[0]["user_type"];


echo "username: ".$username."<br/>";
echo "password: ".$password."<br/>";
echo "email:".$email."<br/>";
echo "user_type:".$user_type."<br/>";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

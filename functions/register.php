<?php 
include('../routes/routes.php');

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$retype_password = $_POST['retype-password'];

registers($firstName, $lastName, $email, $password, $retype_password);
?>
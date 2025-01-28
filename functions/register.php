<?php 
include('../routes/routes.php');

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);

registers($firstName, $lastName, $email, $password_hash);
?>
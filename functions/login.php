<?php
include('../routes/login-routes.php');

$email = $_POST['email'];
$password = $_POST['password'];

login($email, $password);
<?php
include('../routes/routes.php');

$email = $_POST['email'];
$password = $_POST['password'];

login($email, $password);
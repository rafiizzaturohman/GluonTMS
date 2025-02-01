<?php
include('../routes/project-routes.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id = $_POST['user_id'];
$projectName = $_POST['projectName'];

addProjects($user_id, $projectName);
<?php 
include('../routes/routes.php');

// $projectId = $_POST['projectId'];
$userId = $_POST['userId'];
$projectName = $_POST['projectName'];
// $createdAt = $_POST['createdAt'];

addProjects($userId, $projectName);
?>
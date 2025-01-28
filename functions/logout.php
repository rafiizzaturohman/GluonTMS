<?php
session_start();
session_destroy(); // Destroy all session data
header("location: ../index.php"); // Redirect to login page
exit();
?>
<?php

function connectToDB()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "task_management";
    $port = 3306;

    $conn = new mysqli($host, $user, $pass, $db, $port);
    if ($conn->connect_error) {
        die("Failed to Connect" .  $conn->connect_error);
    }
    return $conn;
}

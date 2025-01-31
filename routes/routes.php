<?php
include('../lib/connection.php');

function taskStatusCounter($status)
{
    $connect = connectToDB(); // Assuming this function connects to the database

    // Prepare the query to count tasks based on the provided status
    $query = "SELECT COUNT(*) AS count FROM tasks WHERE status = ?";

    // Prepare the statement
    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

    // Bind the status parameter
    $stmt->bind_param('s', $status); // Use 's' for string type
    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Return the count of tasks
    return $row['count'];
}

// Example usage
$completedCount = taskStatusCounter('completed');
$inProgressCount = taskStatusCounter('in progress');
$pendingCount = taskStatusCounter('pending');
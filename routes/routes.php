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

function getUsersData() {
    $connect = connectToDB();

    // Check if the connection was successful
    if ($connect === false) {
        die('Database connection failed: ' . htmlspecialchars($connect->connect_error));
    }

    $query = "SELECT * FROM users";

    $stmt = $connect->prepare($query);

    // Execute the statement
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    // Get the result
    $result = $stmt->get_result();

    // Fetch all results as an associative array
    $projects = $result->fetch_all(MYSQLI_ASSOC);

    // Free result and close statement
    $result->free();
    $stmt->close();
    $connect->close();

    return $projects;
}

function getProjects()
{
    $connect = connectToDB();

    // Check if the connection was successful
    if ($connect === false) {
        die('Database connection failed: ' . htmlspecialchars($connect->connect_error));
    }

    $query = "SELECT users.user_id, users.firstname, users.lastname, projects.project_id, projects.project_name, projects.created_at 
              FROM projects 
              INNER JOIN users ON projects.user_id = users.user_id";

    $stmt = $connect->prepare($query);

    // Execute the statement
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    // Get the result
    $result = $stmt->get_result();

    // Fetch all results as an associative array
    $projects = $result->fetch_all(MYSQLI_ASSOC);

    // Free result and close statement
    $result->free();
    $stmt->close();
    $connect->close();

    return $projects;
}

function getTasks()
{
    $connect = connectToDB();

    // Check if the connection was successful
    if ($connect === false) {
        die('Database connection failed: ' . htmlspecialchars($connect->connect_error));
    }

    $query = "SELECT users.user_id, users.firstname, users.lastname, tasks.id, projects.project_name, tasks.title, tasks.priority, tasks.status, tasks.created_at, tasks.updated_at  
              FROM tasks 
              INNER JOIN users ON tasks.user_id = users.user_id
              INNER JOIN projects ON tasks.project_id = projects.project_id";

    $stmt = $connect->prepare($query);

    // Execute the statement
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    // Get the result
    $result = $stmt->get_result();

    // Fetch all results as an associative array
    $projects = $result->fetch_all(MYSQLI_ASSOC);

    // Free result and close statement
    $result->free();
    $stmt->close();
    $connect->close();

    return $projects;
}
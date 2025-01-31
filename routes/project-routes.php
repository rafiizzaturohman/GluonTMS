<?php

function getProjects()
{
    $connect = connectToDB();

    // Check if the connection was successful
    if ($connect === false) {
        die('Database connection failed: ' . htmlspecialchars($connect->connect_error));
    }

    $query = "SELECT users.firstname, users.lastname, projects.project_name, projects.created_at 
              FROM projects 
              INNER JOIN users ON projects.user_id = users.user_id";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }

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

function addProjects($userId, $projectName)
{
    $connect = connectToDB();
    $query = "INSERT INTO projects (project_id, user_id, project_name, created_at) VALUES (?, ?, ?, ?)";
}

function deleteProject()
{
    $connect = connectToDB();
    $query = "DELETE FROM projects WHERE ";
}

function updateProject()
{
    $connect = connectToDB();
}

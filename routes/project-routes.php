<?php
include('../lib/connection.php');

function addProjects($projectName, $user_id)
{
    $connect = connectToDB();
    
    $query = "INSERT INTO projects(user_id, project_name) VALUES (?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('is', $user_id, $projectName);    

    if ($stmt->execute()) {
        header('Location: ../page/dashboard.php?');
        exit();
    } else {
        header("Location: ../page/addProject.php?msg=failed_to_add_project");
        exit();
    }

    $stmt->close();
    $connect->close();
}

function deleteProject($project_id, $user_id)
{
    $connect = connectToDB();
    $query = "DELETE FROM projects WHERE project_id = ? AND user_id = ?"; // Corrected the query
    $stmt = $connect->prepare($query);

    $stmt->bind_param('ii', $project_id, $user_id);
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    $connect->close();
}

function updateProject($project_id, $project_name, $user_id)
{
    $connect = connectToDB();
    $query = "UPDATE projects SET project_name = ? WHERE project_id = ? AND user_id = ?";
    $stmt = $connect->prepare($query);

    $stmt->bind_param('sii', $project_name, $project_id, $user_id); // 'sii' for string, integer, integer
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    $connect->close();
}

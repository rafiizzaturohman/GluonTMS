<?php

function getProject() {
    $connect = connectToDB();
    $query = "SELECT users.firstname, users.lastname, projects.project_name, projects.created_at FROM projects INNER JOIN users ON projects.user_id = users.user_id";
    
}

function addProjects($userId, $projectName) {
    $connect = connectToDB();
    $query = "SELECT * FROM users WHERE email = ?";
}

function deleteProject() {
    $connect = connectToDB();
    $query = "DELETE FROM projects WHERE ";
}

function updateProject() {
    $connect = connectToDB();

}
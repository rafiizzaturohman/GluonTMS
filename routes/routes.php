<?php
include('../lib/connection.php');

function registers($firstName, $lastName, $email, $password, $retype_password)
{
    $connect = connectToDB();

    if ($password !== $retype_password) {
        header("location: ../page/register.php?msg=password_not_match");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connect->prepare("INSERT INTO users (firstName, lastName, email, password_hash) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $password_hash);

    if ($stmt->execute()) {
        header("location:../index.php");
    } else {
        header("location: ../page/register.php?msg=registration_failed");
    }

    $stmt->close();
    $connect->close();
}

function login($email, $password)
{
    $connect = connectToDB();
    $query = "SELECT * FROM users WHERE email = ?";

    $stmt = $connect->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password_hash'])) {
                session_start();
                $_SESSION['email'] = $user['email'];
                $_SESSION['status'] = 'login';

                header('location: ../page/dashboard.php');
                exit();
            } else {
                header("location: ../page/login.php?msg=wrong_password");
                exit();
            }
        } else {
            header("location: ../page/login.php?msg=email_not_found");
            exit();
        }
        $stmt->close();
    } else {
        // Handle error
        die("Database query failed: " . $connect->error);
    }
}

function addProjects($userId, $projectName)
{
    $connect = connectToDB();
    $query = "SELECT * FROM users WHERE email = ?";
}

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
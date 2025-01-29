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

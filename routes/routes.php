<?php
include('../lib/connection.php');

function registers($firstName, $lastName, $email, $password)
{
    $connect = connectToDB();
    $query = "INSERT INTO users (firstName, lastName, email, password_hash) VALUES ('$firstName', '$lastName', '$email', '$password')";
    $connect->query($query);
    header("location:../index.php");
}

function login($email, $password) {
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
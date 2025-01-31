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

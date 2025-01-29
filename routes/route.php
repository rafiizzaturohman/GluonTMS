<?php



function registers($firstName, $lastName, $email, $password, $retype_password)
{
    $connect = connectToDB();

    if ($connect->connect_error) {
        header("location: ../page/register.php?msg=db_connection_failed");
        exit();
    }

    if ($password !== $retype_password) {
        header("location: ../page/register.php?msg=password_not_match");
        exit();
    }

    $stmt = $connect->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("location: ../page/register.php?msg=email_exists");
        $stmt->close();
        $connect->close();
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connect->prepare("INSERT INTO users (firstName, lastName, email, password_hash) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $password_hash);

    if ($stmt->execute()) {
        header("location: ../index.php");
    } else {
        header("location: ../page/register.php?msg=registration_failed");
    }

    $stmt->close();
    $connect->close();
}

<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

include('../lib/connection.php'); // Adjust the path as necessary

// Get user_id from the database using the email
$email = $_SESSION['email'];
$connect = connectToDB();
$query = "SELECT user_id FROM users WHERE email = ?";
$stmt = $connect->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . htmlspecialchars($connect->error));
}
$stmt->bind_param('s', $email);
if (!$stmt->execute()) {
    die("Execute failed: " . htmlspecialchars($stmt->error));
}
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();
$connect->close();

if (!$user_id) {
    // Handle the case where user_id is not found
    header("Location: ../index.php?msg=user_not_found");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/stylesheets/styles.css">
    <link rel="stylesheet" href="../public/stylesheets/headfoot.css">
    <link rel="stylesheet" href="../public/stylesheets/project.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="website icon" href="../assets/images/gluonLogo.png" type="png">

    <title>Gluon: Task Management System</title>
</head>

<body>
    <header class="nav-header">
        <div class="nav-logo">
            <a href="../index.php">
                <img src="../assets/images/nav-logo.png" alt="GTMS Logo">
            </a>
        </div>

        <div>
            <ul class="nav-links">
                <li class="backward"><a href="./dashboard.php">Home</a></li>
                <li class="center"><a href="./dashboard.php#pricing">Pricing</a></li>
                <li class="forward"><a class="logout" href="../functions/logout.php">Logout</a> </li>
            </ul>
        </div>
    </header>

    <main>
        <section class="card-box">
            <div class="flex">
                <h1>Add Your Project</h1>
                <a href="./dashboard.php" class="back-btn">Back</a>
            </div>

            <form action="../functions/projectAdd.php" method="post">
                <div class="input-group">
                    <label for="projectName">Project Name</label>
                    <input type="text" id="projectName" placeholder="Enter your project name" name="projectName" class="input-form" required>
                </div>
                <input type="hidden" id="user_id" value="<?= $user_id ?>" name="user_id" class="input-form" required> 

                <button type="submit" class="add-btn">Add Project</button>

                <?php if (isset($_GET['msg'])): ?>
                    <p style="color: red;">
                        <?php
                        if ($_GET['msg'] == 'failed_to_add_project') echo "Failed To Add Project!";
                        ?>
                    </p>
                <?php endif; ?>
            </form>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; Gluon: Task Management System 2025</p>
    </footer>
</body>

</html>
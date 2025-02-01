<?php
session_start();
include('../routes/task-routes.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
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
            <form action="" method="post">
                <div class="input-group">
                    <label for="projectName">Project Name</label>
                    <input type="text" id="projectName" placeholder="Enter your project name" name="projectName" class="input-form" required>
                </div>

                <button type="submit" class="add-btn">Add Project</button>

                <?php if (isset($_GET['msg'])): ?>
                    <p style="color: red;">
                        <?php
                        if ($_GET['msg'] == 'failed_to_add_task') echo "Failed To Add Task!";
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
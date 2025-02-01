<?php
session_start();
include('../routes/routes.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$projects = getProjects();
$tasks = getTasks();

$priceListJsonPath = '../lib/json/priceList.json';

if ($priceListJsonPath === false) {
    die('Error reading the price list JSON file');
}

$priceList = json_decode(file_get_contents($priceListJsonPath), true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/stylesheets/styles.css">
    <link rel="stylesheet" href="../public/stylesheets/headfoot.css">
    <link rel="stylesheet" href="../public/stylesheets/dashboard.css">
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
                <li class="backward"><a href="#dashboard">Home</a></li>
                <li class="center"><a href="#pricing">Pricing</a></li>
                <li class="forward"><a class="logout" href="../functions/logout.php">Logout</a> </li>
            </ul>
        </div>
    </header>

    <main>
        <section id="dashboard" class="card-box">
            <div class="dashboard-box">
                <h1>Overview</h1>
                <hr>

                <h3>Task Status</h3>

                <div class="grid-layout-overview">
                    <div class="overview-card">
                        <p>Resolved</p>

                        <h1 id="completed"><?= $completedCount; ?></h1>
                    </div>
                    <div class="overview-card">
                        <p>On Progress</p>

                        <h1><?= $inProgressCount; ?></h1>
                    </div>
                    <div class="overview-card">
                        <p>Pending</p>

                        <h1><?= $pendingCount; ?></h1>
                    </div>
                </div>
            </div>

            <hr>

            <div class="box-box">
                <div class="flex">
                    <h3>Project List</h3>
                    <a href="./addProject.php"> &#x002B; Add Project</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th scope="col">Project Lead</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($projects as $project) {
                            echo '<tr>';
                            echo '<td scope="row" data-label="Account">' . htmlspecialchars($project['firstname']) . ' ' . htmlspecialchars($project['lastname']) .  '</td>';
                            echo '<td scope="row" data-label="Account">' . htmlspecialchars($project['project_name']) . '</td>';
                            echo '<td data-label="Due Date">' . htmlspecialchars($project['created_at']) . '</td>';
                            echo '<td class="action">';
                            echo '<a class="edit-button" href="./editProject.php?project_id=' . htmlspecialchars($project['project_id']) .  '">Edit</a>';
                            echo '<button class="delete-button" onclick="deleteProject(' . htmlspecialchars($project['project_id']) . ', ' . htmlspecialchars($project['user_id']) . ')">Delete</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- <button onclick="$deleteProject"></button> -->
            <div class="box-box">
                <div class="flex">
                    <h3>Task List</h3>
                    <a href="./addTask.php">&#x002B; Add Task</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th scope="col">Assignee</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Task</th>
                            <th scope="col">Prioity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task) { ?>
                            <tr>
                                <td scope="row" data-label="ssignee"><?= htmlspecialchars($task['firstname']) ?> <?= htmlspecialchars($task['lastname']) ?></td>
                                <td data-label="project-name"><?= htmlspecialchars($task['project_name']) ?></td>
                                <td data-label="task"><?= htmlspecialchars($task['title']) ?></td>
                                <td data-label="priority"><?= htmlspecialchars($task['priority']) ?></td>
                                <td data-label="status"><?= htmlspecialchars($task['status']) ?></td>
                                <td data-label="created-at"><?= htmlspecialchars($task['created_at']) ?></td>
                                <td data-label="updated-at"><?= htmlspecialchars($task['updated_at']) ?></td>
                                <td data-label="updated-at">
                                    <a class="edit-button" href="./editTask.php?task_id=<?= htmlspecialchars($task['id']) ?>">Edit</a>

                                    <button class="delete-button" onclick="deleteProject('<?= htmlspecialchars($task['project_id']) ?>, <?= htmlspecialchars($project['user_id']) ?>, <?= htmlspecialchars($task['id']) ?>')">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="pricing" class="card-box">
            <h1 class="title">Pricing</h1>

            <div class="grid-layout">
                <?php
                foreach ($priceList as $items) {
                    echo '<div class="pricing-block">';
                    echo '<div class="title-block">';
                    echo '<p class="price-title">';
                    echo '<strong>' . htmlspecialchars($items['title']) . '</strong>';
                    echo '</p>';

                    echo '<p class="popularity">' . htmlspecialchars($items['popularity'] ?? 'N/A') . '</p>';
                    echo '</div>';

                    echo '<div>';
                    echo '<p class="price">';
                    echo '<strong>&#x24;' . htmlspecialchars($items['price'] ?? '0') . '</strong>/month';
                    echo '</p>';

                    if ($items['buttonText'] !== 'Sign Up') {
                        echo '<button onclick="window.open(\'https://www.whatsapp.com\', \'_blank\')" class="price-button">' . htmlspecialchars($items['buttonText']) . '</button>';
                    } else {
                        echo '<button onclick="location.href=\'#\'" class="price-button">Payment</button>';
                    }
                    echo '</div>';

                    echo '<div class="benefit-list">';
                    if (isset($items['benefits'])) {
                        foreach ($items['benefits'] as $benefit) {
                            echo '<p><i class="fa fa-check"></i> ' . htmlspecialchars($benefit) . '</p>';
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                };
                ?>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; Gluon: Task Management System 2025</p>
    </footer>
</body>

</html>
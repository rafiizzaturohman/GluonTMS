<?php
session_start();
include('../routes/routes.php');
include('../routes/project-routes.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$projects = getProjects();
// $task = getTasks();

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
                            echo '<td scope="row" data-label="Account">'. htmlspecialchars($project['project_name']) .'</td>';
                            echo '<td data-label="Due Date">' . htmlspecialchars($project['created_at']) . '</td>';
                            echo '<td>';
                            echo '<a href="./edit.php?user_id=?">Edit</a>';
                            echo '<a href="./edit.php?user_id=?">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row" data-label="ssignee">Visa - 3412</td>
                            <td data-label="project-name">04/01/2016</td>
                            <td data-label="task">$1,190</td>
                            <td data-label="priority">03/01/2016 - 03/31/2016</td>
                            <td data-label="status">03/01/2016 - 03/31/2016</td>
                            <td data-label="created-at">03/01/2016 - 03/31/2016</td>
                            <td data-label="updated-at">03/01/2016 - 03/31/2016</td>
                        </tr>
                        <tr>
                            <td scope="row" data-label="assignee">Visa - 6076</td>
                            <td data-label="project-name">03/01/2016</td>
                            <td data-label="task">$2,443</td>
                            <td data-label="priority">02/01/2016 - 02/29/2016</td>
                            <td data-label="status">02/01/2016 - 02/29/2016</td>
                            <td data-label="created-at">02/01/2016 - 02/29/2016</td>
                            <td data-label="updated-at">02/01/2016 - 02/29/2016</td>
                        </tr>
                        <tr>
                            <td scope="row" data-label="assignee">Corporate AMEX</td>
                            <td data-label="project-name">03/01/2016</td>
                            <td data-label="task">$1,181</td>
                            <td data-label="priority">02/01/2016 - 02/29/2016</td>
                            <td data-label="status">02/01/2016 - 02/29/2016</td>
                            <td data-label="created-at">02/01/2016 - 02/29/2016</td>
                            <td data-label="updated-at">02/01/2016 - 02/29/2016</td>
                        </tr>
                        <tr>
                            <td scope="row" data-label="assignee">Visa - 3412</td>
                            <td data-label="project-name">02/01/2016</td>
                            <td data-label="task">$842</td>
                            <td data-label="priority">01/01/2016 - 01/31/2016</td>
                            <td data-label="status">01/01/2016 - 01/31/2016</td>
                            <td data-label="created-at">01/01/2016 - 01/31/2016</td>
                            <td data-label="updated-at">01/01/2016 - 01/31/2016</td>
                        </tr>
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
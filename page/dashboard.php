<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

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
        <section id="dashboard" class="dashboard-card">
            <h1>Gluon Dashboard</h1>
            <hr>
            <h3>Overview</h3>

            <div class="grid-layout-overview">
                <div class="overview-card">
                    <p>Resolved</p>

                    <h1>31</h1>
                </div>
                <div class="overview-card">
                    <p>On Progress</p>

                    <h1>18</h1>
                </div>
                <div class="overview-card">
                    <p>Not Yet Started</p>

                    <h1>6</h1>
                </div>
            </div>
        </section>

        <section id="task" class="task-card">
            <h3>Task List</h3>

            <div class="grid-layout">
                <div class="card-list">
                    <div>
                        <h4>COY</h4>
                    </div>
                </div>
                <div class="card-list">
                    <div>
                        <h4>COY</h4>
                    </div>
                </div>
                <div class="card-list">
                    <div>
                        <h4>COY</h4>
                    </div>
                </div>
                <div class="card-list">
                    <div>
                        <h4>COY</h4>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing" class="card-pricing">
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

                    if (!isset($_SESSION['email'])) {
                        if ($items['buttonText'] !== 'Sign Up') {
                            echo '<button onclick="window.open(\'https://www.whatsapp.com\', \'_blank\')" class="price-button">' . htmlspecialchars($items['buttonText']) . '</button>';
                        } else {
                            echo '<button onclick="location.href=\'../page/register.php\'" class="price-button">' . htmlspecialchars($items['buttonText']) . '</button>';
                        }
                    } else {
                        if ($items['buttonText'] !== 'Sign Up') {
                            echo '<button onclick="window.open(\'https://www.whatsapp.com\', \'_blank\')" class="price-button">' . htmlspecialchars($items['buttonText']) . '</button>';
                        } else {
                            echo '<button onclick="location.href=\'#\'" class="price-button">Payment</button>';
                        }
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
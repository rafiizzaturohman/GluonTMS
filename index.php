<?php
$priceList = '[
    {
        "title": "Free",
        "popularity": "Popular", 
        "price": "0",
        "buttonText": "Sign Up",
        "benefits": {
            "one": "14 Days Trial",
            "two": "Basic Feature",
            "three": "Limited Users",
            "four": "Email Support"
        }
    }, 
    {
        "title": "Starter",
        "popularity": "Best Value", 
        "price": "10",
        "buttonText": "Sign Up",
        "benefits": {
            "two": "Basic Feature",
            "three": "Limited Users",
            "four": "Email Support"
        }
    },
    {
        "title": "Pro",
        "popularity": "Custom", 
        "price": "20",
        "buttonText": "Sign Up",
        "benefits": {
            "two": "All Features",
            "three": "Unlimited Users",
            "four": "Priority Support"
        }
    },
    {
        "title": "Enterprise",
        "popularity": "", 
        "price": "30",
        "buttonText": "Contact Us",
        "benefits": {
            "one": "Custom Features",
            "three": "Dedicated Support",
            "four": "SLA Guarantee"
        }
    }
]';

// Decode the JSON string
$priceListDecode = json_decode($priceList, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./public/stylesheets/styles.css">
    <link rel="stylesheet" href="./public/stylesheets/headfoot.css">
    <link rel="stylesheet" href="./public/stylesheets/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="./assets/images/20250127_182602.png" type="image/x-icon">

    <title>Gluon: Task Management System</title>
</head>

<body>
    
    <header class="nav-header">
        <div class="nav-logo">
            <a href="#main-index">
                <img src="./assets/images/nav-logo.png" alt="GTMS Logo">
            </a>
        </div>
        <div>
            <ul class="nav-links">
                <li class="backward"><a href="#pricing">Pricing</a></li>
                <li class="center"><a class="signup" href="./page/register.php">Sign Up</a></li>
                <li class="forward"><a class="login" href="./page/login.php">Log In</a></li>
            </ul>
        </div>
    </header>

    <main id="main-index">
        <section id="about" class="card-main">
            <div>
                <img src="./assets/images/main-logo.png" alt="GTMS">
            </div>

            <div>
                <article class="main-article">
                    <strong>Gluon: Task Management System</strong><br />
                    is a web-based application to manage tasks for each user similar to a todo list.
                    <br />
                    <br />
                    It can be used by any team or individual to manage their work. It's designed to help you stay organized and focused, so you can get more done.
                </article>
            </div>
        </section>

        <section id="pricing" class="card-pricing">
            <h1 class="title">Pricing</h1>

            <div class="grid-layout">
                <?php
                foreach ($priceListDecode as $items) {

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
                        echo '<button onclick="window.open(\'https://www.whatsapp.com\', \'_blank\')" class="price-button">'.htmlspecialchars($items['buttonText']).'</button>';
                    } else {
                        echo '<button onclick="location.href=\'./page/register.php\'" class="price-button">'.htmlspecialchars($items['buttonText']).'</button>';
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
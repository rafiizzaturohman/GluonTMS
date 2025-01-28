<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/stylesheets/styles.css">
    <link rel="stylesheet" href="../public/stylesheets/headfoot.css">
    <link rel="stylesheet" href="../public/stylesheets/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="./assets/images/20250127_182602.png" type="image/x-icon">

    <script src="../public/javascript/index.js"></script>

    <title>Gluon: Task Management System - Register</title>
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
                <li class="backward"><a href="../index.php">Home</a></li>
                <li class="center"><a href="../index.php">Pricing</a></li>
                <li class="forward"><a class="login" href="#">Log In</a></li>
            </ul>
        </div>
        <!-- &#9776; -->
    </header>

    <main>
        <section id="register" class="register-form">
            <h1 class="reg-title">Welcome to Gluon: Task Management System</h1>

            <form action="../functions/register.php" method="post">
                <div class="input-block">
                    <div class="grid-layout">
                        <div class="input-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="input-form" required>
                        </div>

                        <div class="input-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="input-form" required>
                        </div>
                    </div>
                </div>

                <div class="input-block">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="input-form" required>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="input-form" required>
                    </div>

                    <div class="input-group">
                        <label for="retype-password">Retype Password</label>
                        <input type="password" id="retype-password" name="retype-password" class="input-form" required>
                    </div>
                </div>

                <div class="block-button">
                    <a href="login.php" class="login-link">Already have na account?</a>

                    <button type="submit" class="signup-btn">Sign Up</button>
                </div>
            </form>



        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; Gluon: Task Mangement System 2025</p>
    </footer>
</body>

</html>
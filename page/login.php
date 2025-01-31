<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/stylesheets/styles.css">
    <link rel="stylesheet" href="../public/stylesheets/headfoot.css">
    <link rel="stylesheet" href="../public/stylesheets/login.css">
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
                <li class="backward"><a href="../index.php">Home</a></li>
                <li class="center"><a href="../index.php">Pricing</a></li>
                <li class="forward"><a class="login" href="./register.php">Sign Up</a></li>
            </ul>
        </div>
    </header>

    <main>
        <section id="login-form" class="card-box">
            <div class="login-form">
                <h1 class="login-title">Login to Gluon: Task Management System</h1>
    
                <form action="../functions/login.php" method="post">
                    <div>
                        <div class="input-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" placeholder="Enter your email" name="email" class="input-form" required>
                        </div>
    
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" placeholder="Enter your password" name="password" class="input-form" required>
                        </div>
                    </div>
    
                    <?php if (isset($_GET['msg'])): ?>
                        <p style="color: red;">
                            <?php
                            if ($_GET['msg'] == 'email_not_found') echo "Email not found!";
                            if ($_GET['msg'] == 'wrong_password') echo "Wrong Password!";
                            ?>
                        </p>
                    <?php endif; ?>
    
                    <div class="block-button">
                        <a href="./register.php" class="reg-link">Does not have an account yet?</a>
    
                        <button type="submit" class="login-btn">Log In</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <p>&copy; Gluon: Task Management System 2025</p>
    </footer>
</body>

</html>
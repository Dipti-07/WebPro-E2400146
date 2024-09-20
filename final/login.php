<?php
session_start();  

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'final';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password, usertype FROM users WHERE username=?");
    if ($stmt === false) {
        die('Prepare Error: ' . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) { 
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = $user['usertype'];

            // Redirect based on user type
            if ($user['usertype'] === 'admin') {
                header('Location: users/admin.php'); // Redirect to admin page
            } else {
                header('Location: index.php'); // Redirect to a general user page
            }
            exit;
        } else {
            echo '<script>alert("Invalid password");</script>';
        }
    } else {
        echo '<script>alert("Username not found");</script>';
    }    
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - D&C Beauty Salon</title>
    <link rel="stylesheet" href= "styles/styles.css">
    <script src= " scripts/main.js"  defer></script>
</head>
<body class="contact">
    <!-- Header and Navigation -->
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="images/logo.png" alt="D&C Beauty Salon Logo">
            </div>
            <h1>D&C Beauty Salon</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="appointment.php">Appointment</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Signup</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Login Section -->
    <section id="account">
        <div class="auth-section">
            <h2>Login</h2>
            <p>Login to book appointments and manage your profile.</p>

            <div class="auth-container">
                <div class="auth-box">
                    <form id="login-form" class="auth-form" action="login.php" method="post">
                        <input type="text" id="username" name="username" placeholder="Username" required>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <div class="button-container">
                            <button type="submit" class="loog" name="login">Login</button>
                        </div>
                        <p class="auth-message hidden">Login successful!</p>
                    </form>
                </div>
                <a href="signup.php">Don't have an account yet? Sign up</a>
            </div>
        </div>
    </section>
     
    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="location.php">Location</a></li>
                    <li><a href="about.php">About Us</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <h3>Get Connected</h3>
                <p>Phone: 9888990000 | 01-4777770</p>
                <p>Email: <a href="mailto:info@D&Cbeautysalon.com">info@D&Cbeautysalon.com</a> | <a href="mailto:press@D&Cbeautysalon.com">press@D&Cbeautysalon.com</a></p>
                <div class="social-media">
                    <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="images/instagram.png" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <p class="footer-bottom">© 2024 D&C Beauty Salon. All Rights Reserved.</p>
    </footer>
    <button id="go-to-top">↑</button>
</body>
</html>

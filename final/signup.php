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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];
 
    if ($password === $cpassword) {
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? OR username=?");
        if ($stmt === false) {
            die('Prepare Error: ' . $conn->error);
        }
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            echo '<script>alert("Email or Username already exists");</script>';
        } else {
            
            $stmt = $conn->prepare("INSERT INTO users (name, email, mobile, username, password, usertype, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 1, NOW())");
            if ($stmt === false) {
                die('Prepare Error: ' . $conn->error);
            }
  
            $stmt->bind_param("ssssss", $name, $email, $mobile, $username, $password, $user_type);
  
            if ($stmt->execute()) {
                
                $stmt->close();
                $conn->close();
            
                echo '<script>
                        alert("User registered successfully");
                        window.location.href = "login.php";
                      </script>';
                exit;
            } else {
                die('Execute Error: ' . $stmt->error);
            }
        }
    } else {
        echo '<script>alert("Passwords do not match");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - D&C Beauty Salon</title>
    <link rel="stylesheet" href= "styles/styles.css">
    <script src= " scripts/main.js"  defer></script>
</head>
<body class="appointment">
    <!-- Header and Navigation -->
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="images/logo.png" alt="D&C Beauty Salon Logo" class="logo">
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

    <!-- Signup Section -->
    <section id="account">
        <div class="auth-section">
            <h2>Sign Up</h2>
            <p>Create an account to book appointments and manage your profile.</p>
            
            <div class="auth-container">
                <div class="auth-box">
                    <form id="signup-form" class="auth-form" action="signup.php" method="post">
                        <input type="text" id="name" name="name" placeholder="Name" required>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        <input type="text" id="username" name="username" placeholder="Username" required>
                        <input type="text" id="mobile" name="mobile" placeholder="Mobile" required>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                        <select id="user_type" name="user_type" required>
                            <option value="customer">Customer</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="button-container">
                            <button type="submit" class="register" name="register">Register</button>
                        </div>
                    </form>
                </div>
                 
                    <a href="login.php">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </section>
  
    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="location.html">Location</a></li>
                    <li><a href="about.html">About Us</a></li>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&C Beauty Salon</title>
    <link rel="stylesheet" href= "styles/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src= " scripts/main.js"  defer></script>
</head>
<body class="index">
    <!-- Header Section -->
    <header>
        <div class="header-container">
            <div class="logo">              
                <img src="images/logo.png" alt="D&C Beauty Salon Logo">
            </div>
            <h1>D&C Beauty Salon</h1>
            <button class="nav-toggle" aria-label="Toggle navigation">
                <div class="nav-toggle-icon"></div>
                <div class="nav-toggle-icon"></div>
                <div class="nav-toggle-icon"></div>
            </button>
            <nav class="nav-menu">
                <ul>
                     <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li class="services">
                        <a href="services.php">Services</a>
                        <ul class="dropdown-menu">
                        <li><a href="services.php#facials">Facials</a></li>
                            <li><a href="services.php#bridal-makeup">Bridal Makeup</a></li>
                            <li><a href="services.php#nail-extensions">Nail Extensions</a></li>
                            <li><a href="services.php#hair-styling">Hair Styling</a></li>
                            <li><a href="services.php#manicure-pedicure">Manicure & Pedicure</a></li>
                            <li><a href="services.php#eyelash-extensions">Eyelash Extensions</a></li>
                            <li><a href="services.php#hair-removal">Hair Removal</a></li>
                        </ul>
                    </li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="appointment.php">Appointment</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Signup</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Home Section -->
<section id="intro" class="intro-section">
    <div class="intro-container">
        <img src="./images/salon.jpg" alt="Salon Background" class="intro-bg">
        <div class="intro-content">
            <h2>Welcome to D&C Beauty Salon</h2>
            <p>Your beauty is our passion. Discover a variety of services tailored just for you.</p>
            <a href="appointment.php">
                <button class="btn-book">Book an Appointment</button>
            </a>
        </div>
    </div>
</section>

 
 
<!-- Services Section -->
<section id="offerings" class="offerings-section text-center">
    <h2>Our Services</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offering">
                <a href="services.php#facials">
                    <img src="./images/facial.jpeg" alt="Facials" class="img-fluid offering-img">
                    <h3>Facials</h3>
                    <p>Rejuvenating facials to keep your skin glowing.</p>
                </a>
            </div>
            <div class="col-md-4 offering">
                <a href="services.php#bridal-makeup">
                    <img src="./images/bridal makeup.jpg" alt="Bridal Makeup" class="img-fluid offering-img">
                    <h3>Bridal Makeup</h3>
                    <p>Elegant bridal makeup that enhances your natural beauty for your special day.</p>
                </a>
            </div>
            <div class="col-md-4 offering">
                <a href="services.php#nail-extensions">
                    <img src="./images/Nail-extension.jpg" alt="Nail Extensions" class="img-fluid offering-img">
                    <h3>Nail Extensions</h3>
                    <p>Get beautiful, long-lasting nail extensions with a variety of designs.</p>
                </a>
            </div>
            <div class="col-md-4 offering">
                <a href="services.php#hair-styling">
                    <img src="./images/hairstyle.jpg" alt="Hair Styling" class="img-fluid offering-img">
                    <h3>Hair Styling</h3>
                    <p>Professional hair styling services for every occasion.</p>
                </a>
            </div>
            <div class="col-md-4 offering">
                <a href="services.php#manicure-pedicure">
                    <img src="./images/manicure-pedicure.jpg" alt="Manicure & Pedicure" class="img-fluid offering-img">
                    <h3>Manicure & Pedicure</h3>
                    <p>Relaxing manicure and pedicure services for beautiful hands and feet.</p>
                </a>
            </div>
            <div class="col-md-4 offering">
                <a href="services.php#eyelash-extensions">
                    <img src="./images/eyelash.jpeg" alt="Eyelash Extensions" class="img-fluid offering-img">
                    <h3>Eyelash Extensions</h3>
                    <p>Beautiful eyelash extensions for a fuller, longer lash look.</p>
                </a>
            </div>
            <div class="col-md-4 offering">
                <a href="services.php#hair-removal">
                    <img src="./images/hair-removal.jpg" alt="Hair Removal" class="img-fluid offering-img">
                    <h3>Hair Removal</h3>
                    <p>Effective hair removal services for smooth, hair-free skin.</p>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Gallery Section -->
<section id="showcase" class="showcase-section text-center">
<a href=" gallery.php">
    <h2>Gallery</h2>
    </a>
    <div class="showcase-container">
         
        <div class="showcase-wrapper">
            <div class="showcase-item">
                <img src="./images/hair-removal.jpg" alt="Showcase Image 1" class="img-fluid">
            </div>
            <div class="showcase-item">
                <img src="./images/eyelash.jpeg" alt="Showcase Image 2" class="img-fluid">
            </div>
            <div class="showcase-item">
                <img src="./images/manicure-pedicure.jpg" alt="Showcase Image 3" class="img-fluid">
            </div>
            <div class="showcase-item">
                <img src="./images/hairstyle.jpg" alt="Showcase Image 4" class="img-fluid">
            </div>
            <div class="showcase-item">
                <img src="./images/Nail-extension.jpg" alt="Showcase Image 5" class="img-fluid">
            </div>
            <div class="showcase-item">
                <img src="./images/bridal makeup.jpg" alt="Showcase Image 6" class="img-fluid">
            </div>
            <div class="showcase-item">
                <img src="./images/facial.jpeg" alt="Showcase Image 7" class="img-fluid">
            </div>
        </div>
        <button id="scroll-right" class="scroll-btn" aria-label="Scroll Right">&gt;</button>
    </div>
     
</section>

 
 

<!-- Login/Signup Section -->
<section id="access" class="access-section text-center">
    <div class="container">
        <h2 class="section-heading">Access Your Account</h2>
        <p class="section-summary">Welcome back! Please login to continue or sign up if you're new here. We're excited to have you join our community!</p>
        <div class="row">
            <div class="col-md-6">
                <div class="account-card">
                    <img src="./images/R.jpeg" alt="Login Icon" class="account-icon">
                    <h3 class="account-header"></h3>
                    <p class="account-description">Already a member? Sign in to access your account and manage your bookings.</p>
                    <a href="login.php">
                        <button class="login-btn">Login</button>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="account-card">
                    <img src="./images/OIP.jpeg" alt="Signup Icon" class="account-icon">
                    <h3 class="account-header"></h3>
                    <p class="account-description">New here? Create an account to book services and receive exclusive offers.</p>
                    <a href="signup.php">
                        <button class="signup-btn">Signup</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="get-in-touch" class="contact-section text-center">
    <h2>Contact Us</h2>
    <p>If you have any questions or need more information, feel free to reach out to us.</p>
    <a href="contact.php">
        <button class="contact-btn">Contact</button>
    </a>
    <div class="contact-details">
        <p>Email: <a href="mailto:info@d&cbeautysalon.com">info@d&cbeautysalon.com</a></p>
        <p>Phone: <a href="tel:9888990000">9888990000 | 01-4777770</a></p>
        <p>Address: 123 Beauty Lane, Glamour City, BC 12345</p>
    </div>
</section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-left">
                 
            </div>
            <div class="footer-right">
                
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

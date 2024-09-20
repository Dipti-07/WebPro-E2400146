<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - D&C Beauty Salon</title>
    <link rel="stylesheet" href= "styles/styles.css">
    <script src="scripts/contact.js" type="text/javascript" defer></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
       (function(){
          emailjs.init("Y47HJdXXF-vjzgma8");
       })();
    </script>   
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
                    <li><a href="signup.php ">Signup</a></li> 
                </ul>
            </nav>
        </div>
    </header>
     <!-- Contact Section -->
     <section id="this">  
      
        <div class="recieve-section">
            <h2>Contact Us</h2>
            <p>Feel free to reach out to us for any inquiries or feedback.</p>

            <form id="form" class="form" onsubmit="SendMail(event)">
                <div class="row">
                    <div class="group">
                        <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
                    </div>
                    <div class="group">
                        <input type="text" id="subject" name="subject" placeholder="Subject" required>
                    </div>
                </div>
                <div class="row">
                    <div class="group">
                        <input type="email" id="email_id" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="group">
                        <input type="text" id="phone" name="phone" placeholder="Phone Number">
                    </div>
                </div>
                <div class="group full-width">
                    <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                </div>

                <button type="submit" class="submit">Send Message</button>
                <p id="contact-message" class="contact-message hidden">Message sent successfully!</p>
            </form>
        </div>
    </section>

    <div id="confirmation" style="display: none;">
    <h3>Message Sent!</h3>
    <p>Thank you for reaching out. We will get back to you soon.</p>
    <button id="BackBtn">Go Back</button>
</div>
</body>
    <!-- Location Section -->
    <section id="location">
        <h2>Our Location</h2>
        <p>Find D&C Beauty Salon at the following address:</p>
        <address>
            <p>123 Beauty Street, Glamour City, BC 45678</p>
            <p>Phone: 9888990000 | 01-4777770</p>
            <p>Email: <a href="mailto:info@D&Cbeautysalon.com">info@D&Cbeautysalon.com</a></p>
        </address>
        <div class="map">
            <!-- Google Maps for Kathmandu -->
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14104.366724977818!2d85.30905077414715!3d27.717245145437866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb191bfae3a73b%3A0xc4d2d9d035e9d5f3!2sKathmandu!5e0!3m2!1sen!2snp!4v1646791149327!5m2!1sen!2snp" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
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

<?php
require 'users/connect.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['service'], $_POST['date'], $_POST['time'])) {
        
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $service = htmlspecialchars($_POST['service']);
        $date = htmlspecialchars($_POST['date']);
        $time = htmlspecialchars($_POST['time']); 
        $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, service, date, time) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $phone, $service, $date, $time);

        if ($stmt->execute()) {           
            echo json_encode([
                'success' => true,
                'data' => [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'service' => $service,
                    'date' => $date,
                    'time' => $time
                ]
            ]);
        } else {
             
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
        }
        $stmt->close();
        $conn->close();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment - D&C Beauty Salon</title>
    <link rel="stylesheet" href= "styles/styles.css">
    <script src=" scripts/appointment.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

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
                    <li><a href="signup.php ">Signup</a></li> 
                </ul>
            </nav>
        </div>
    </header>
 <!-- Appointment Section -->
<section id="appointment">
    <h2>Book Your Appointment</h2>
    <p>Fill out the form below to book your appointment with us.</p>
    <form id="appointment-form" method="POST" action="appointment.php">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="service">Select Service:</label>
        <select id="service" name="service" required>
            <option value="facial">Facial</option>
            <option value="bridal-makeup">Bridal Makeup</option>
            <option value="nail-extensions">Nail Extensions</option>
            <option value="hair-styling">Hair Styling</option>
            <option value="manicure-pedicure">Manicure & Pedicure</option>
            <option value="eyelash-extensions">Eyelash Extensions</option>
            <option value="hair-removal">Hair Removal</option>
        </select>

        <label for="date">Preferred Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Preferred Time:</label>
        <input type="time" id="time" name="time" required>

        <button type="submit" name="book_appointment">Book Appointment</button>
    </form>

    <!-- Confirmation Section for Booking -->
    <div id="appointment-confirmation" class="confirmation" style="display:none;">
        <h3>Appointment Confirmation</h3>
        <p>Thank you, <span id="confirmName"></span>! Your appointment for <span id="confirmService"></span> on <span id="confirmDate"></span> at <span id="confirmTime"></span> has been booked.</p>
        <p>We have sent a confirmation email to <span id="confirmEmail"></span>. If you need to make any changes, please contact us at <span id="confirmPhone"></span>.</p>
        <button id="downloadButton" type="button" onclick="generatePDF()">Download Receipt</button>
        <button type="button" onclick="goBack()">Go Back</button>
    </div>
</section>

<br><br>

<!-- Reschedule or Cancel Section -->
<section id="manage-appointment">
    <h3>Manage Your Appointment</h3>
    <p>If you need to reschedule or cancel your appointment, please enter your details below.</p>
    <form id="manage-appointment-form">
        <label for="email-manage">Email:</label>
        <input type="email" id="email-manage" name="email-manage" required>

        <label for="phone-manage">Phone:</label>
        <input type="tel" id="phone-manage" name="phone-manage" required>

        <label for="action">Select Action:</label>
        <select id="action" name="action" required>
            <option value="reschedule">Reschedule</option>
            <option value="cancel">Cancel</option>
        </select>

        <div id="reschedule-options" class="reschedule-options" style="display:none;">
            <label for="new-date">New Preferred Date:</label>
            <input type="date" id="new-date" name="new-date">

            <label for="new-time">New Preferred Time:</label>
            <input type="time" id="new-time" name="new-time">
        </div>

        <button type="submit">Submit</button>
    </form>

    <!-- Confirmation Section for Rescheduling -->
    <div id="reschedule-confirmation" class="ok-confirmation" style="display:none;">
        <h3>Appointment Confirmation</h3>
        <p>Thank you, <span id="confirmNameReschedule"></span>! Your appointment for <span id="confirmServiceReschedule"></span> on <span id="confirmDateReschedule"></span> at <span id="confirmTimeReschedule"></span> has been rescheduled.</p>
        <p>We have sent a confirmation email to <span id="confirmEmailReschedule"></span>. If you need to make any changes, please contact us at <span id="confirmPhoneReschedule"></span>.</p>
        <button id="downloadButtonReschedule" type="button" onclick="generatePDF()">Download Receipt</button>
        <button type="button" onclick="goBack()">Go Back</button>
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
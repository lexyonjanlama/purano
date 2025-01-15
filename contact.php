<?php
// Include the database connection file
include 'dbconnection.php';

// Initialize feedback status message
$success = "";
$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate form data
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepare an SQL query to insert data into the feedbacks table
        $query = "INSERT INTO feedbacks (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        try {
            // Execute the query
            $stmt->execute([$name, $email, $message]);

            // Success message
            $sucess = "Thank you for your feedback!";
        } catch (PDOException $e) {
            // Error handling
            $error = "Error saving feedback: " . $e->getMessage();
        }
    } else {
        // Error message for incomplete form
        $error = "All fields are required!";
    }
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon-96x96.png" sizes="96x96" />
    <title>Contact Us - Online Sports Store</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Sports Store Logo">
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="contact-section">
        <h1>Contact Us</h1>
        <br>
        <h4>Send us the feedback by filling the form</h4>

        <!-- Display the status message -->
        <?php if ($success): ?>
            <p style="color: green; font-weight: bold;"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php endif; ?>

        <div class="contact-container">
            <!-- Feedback Form -->
            <div class="contact-form">
                <form method="POST" action="">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                    
                    <button type="submit">Submit</button>
                </form>
            </div>
            
            <!-- Contact Details -->
            <div class="contact-details">
                <h2>Get in Touch</h2>
                <p><strong>Address:</strong> Near NCMT College, Samakhusi, Kathmandu</p>
                <p><strong>Email:</strong> onlinesports@gmail.com</p>
                <p><strong>Phone:</strong> 01-3455555, 9818045545</p>
                <p><strong>Social Media:</strong></p>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>About Our Store</h3>
                <p>Your one-stop shop for all sports gear and accessories. 
                <br> You can find jerseys, kits, sports items, and other sports items here.
                <br> You can order online and pay using QR or cash on delivery.</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="faqs.html">FAQs</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p>Near NCMT College, Samakhusi, Kathmandu</p>
                <p>onlinesports@gmail.com</p>
                <p>01-3455555, 9818045545</p>
            </div>
        </div>
        <div class="copyright">&copy; 2024 Online Sports Store. All Rights Reserved.</div>
    </footer>
</body>
</html>

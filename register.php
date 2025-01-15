<?php
// Include the database connection file
include 'dbconnection.php';

// Initialize feedback status message
$success = "";
$error = "";
$hashed_password = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
	$username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile_no'];
	$password = $_POST['password'];
	$confirmPass = $_POST['confirm_password'];

    // Validate form data
    if (!empty($name) && !empty($username) && !empty($email) && !empty($mobile) && !empty($password) && !empty($confirmPass)) {
		
		if ($password !== $confirmPass) {
			$error = "Password and Confirm Password do not match.";
		} else {
        // Hash the password
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			
			$query = "INSERT INTO users (name, username, email, number, password) VALUES (?, ?, ?, ?, ?)";
			$stmt = $con->prepare($query);

			try {
				// Execute the query
				$stmt->execute([$name, $username, $email, $mobile, $hashed_password]);

				// Success message
				$success = "Succesfully Registered!";
			} catch (PDOException $e) {
				// Error handling
				$error = "Error during registration: " . $e->getMessage();
			}
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
    <title>Register | Online Sports Store</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="registration-container">
        <h2>Register</h2>
        <?php if ($success): ?>
            <p style="color: green; font-weight: bold;"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
			
			<label for="name">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="mobile">Mobile No:</label>
            <input type="text" id="mobile_no" name="mobile_no" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Register</button><br>
        </form>
			<h5>Already registered? Please login</h5>
		    <a href="login.php"><button class="myBtn">Login</button> </a>
    </div>
</body>
</html>

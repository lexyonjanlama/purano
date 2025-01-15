<?php
// Include the database connection file
include "dbconnection.php";

// Initialize feedback status message
$success = "";
$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate form data
    if (!empty($username) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Prepare an SQL query to insert data into the feedbacks table
        $query = "select * from users where username = '$username'";
        $result = mysqli_query($con, $query);
        if ($row = mysqli_fetch_array($result)) {
            $count = mysqli_num_rows($result);
            $dbPass = $row["password"];
            $verify = password_verify($password, $dbPass);

            try {
                // Execute the) query
                if ($count == 1) {
                    if ($verify == 1) {
                        $success = "Succesfully Logged in!";
                    } else {
                        $error = "Invalid Credentails";
                    }
                } else {
                    $error = "Incorrect username or password";
                }
            } catch (PDOException $e) {
                // Error handling
                $error = "Cannot Login: " . $e->getMessage();
            }
        } else {
            $error = "Usename not found";
        }
    } else {
        // Error message for incomplete form
        $error = "All fields are required!";
    }
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon-96x96.png" sizes="96x96" />
    <title>Login | Online Sports Store</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="registration-container">
        <h2>Login to Online Sports Site</h2>
        <?php if ($success): ?>
            <p style="color: green; font-weight: bold;"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="email">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button><br>
        </form>
			<h5>Not registered yet? Please register</h5>
		    <a href="register.php"><button class="myBtn">Register</button></a>
    </div>
</body>
</html>

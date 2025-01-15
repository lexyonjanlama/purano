<?php
// Database credentials
$host = 'localhost'; // Replace with your host (e.g., 127.0.0.1 or an IP address)
$dbname = 'purano_store'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create a connection
$con = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
//else {
  //  echo "Connected successfully!";
// }

// Close the connection when done
 //$con->close();
?>

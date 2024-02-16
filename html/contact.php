<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "CS351_groupProject"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password,
 $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else {
    echo("Good");
};

// Retrieve form data
$name = $_POST['name'];
$title = $_POST['title'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare and execute SQL query to insert data into the contacts table
$sql = "INSERT INTO contacts (name, title, email, message) VALUES (?, ?, ?, ?)";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ssss", $name, $title, $email, $message);

// Execute statement
if ($stmt->execute()) {
    echo "Contact information saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
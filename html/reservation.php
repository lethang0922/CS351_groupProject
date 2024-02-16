<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "CS351_groupProject"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['Name'];
$guests = $_POST['Guests'];
$date_time = $_POST['date'];
$special_requests = $_POST['Message'];
$place = $_POST['place'];

// Prepare and execute SQL query to insert data into the reservations table
$sql = "INSERT INTO reservations (name, guests, date_time, special_requests, place) VALUES (?, ?, ?, ?, ?)";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sisss", $name, $guests, $date_time, $special_requests, $place);

// Execute statement
if ($stmt->execute()) {
    echo "Reservation saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

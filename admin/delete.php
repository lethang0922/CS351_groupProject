<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

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

// Check if reservation ID is set and not empty
if (isset($_POST['reservation_id']) && !empty($_POST['reservation_id'])) {
    // Sanitize the reservation ID to prevent SQL injection
    $reservation_id = $conn->real_escape_string($_POST['reservation_id']);

    // Prepare SQL statement to delete the reservation
    $sql = "DELETE FROM reservations WHERE reservation_id = '$reservation_id'";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Reservation deleted successfully
       // header("Location: admin_dashboard.php#reservationdisplay"); // Redirect back to admin panel with anchor
       echo "<script>window.location = 'admin_dashboard.php#reservationdisplay';</script>";

       exit;
    } else {
        // Error deleting reservation
        echo "Error: " . $conn->error;
    }
} else {
    // Reservation ID not set or empty
    echo "Invalid reservation ID";
}

// Close connection
$conn->close();
?>

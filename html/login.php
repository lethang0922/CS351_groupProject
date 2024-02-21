<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "CS351_groupProject"; // Replace with your database name

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from POST data
    $admin_username = $_POST['ID'];
    $admin_password = $_POST['title'];

    // Query the admin table for the provided username , use your table name that you created in database
    $sql = "SELECT * FROM admin WHERE admin_name='$admin_username'";
    $result = $conn->query($sql);

    // Debugging statements
    echo "SQL Query: $sql<br>";
    echo "Number of rows: " . $result->num_rows . "<br>";

    if ($result->num_rows == 1) {
        // Admin username exists, now check password
        $row = $result->fetch_assoc();

        if ($row['admin_pass'] == $admin_password) {
            // Password matches, admin authenticated, set session variable
            $_SESSION['admin_loggedin'] = true;
            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            exit;
        } else {
            // Invalid password
            echo "Invalid password";
        }
    } else {
        // Admin username not found
        echo "Admin username not found";
    }
}
?>

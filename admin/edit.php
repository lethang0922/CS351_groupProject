<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Database connection
$connection = mysqli_connect("localhost", "root", "", "CS351_groupProject");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['updatebtn'])){
    $reservation_id = $_POST['edit_id'];
    $name = $_POST['edit_name'];
    $guests = $_POST['edit_guests'];
    $date_time = $_POST['edit_date_time'];
    $special_requests = $_POST['edit_special_requests'];
    $place = $_POST['edit_place'];

    $query = "UPDATE reservations SET name='$name', guests='$guests', date_time='$date_time', special_requests='$special_requests', place='$place' WHERE reservation_id='$reservation_id'";
    
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Your Data is Updated";
        header('Location: admin_dashboard.php');
    } else {
        $_SESSION['status'] = "Your Data is not Updated";
        echo "Error: " . mysqli_error($connection);
        header('Location: edit_form.php');
    }
}

mysqli_close($connection);
?>

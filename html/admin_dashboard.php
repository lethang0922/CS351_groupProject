<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Close connection
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ha'Matata Restaurant</title>
  <link rel="stylesheet" href="../CSS/header.css">
  <link rel="stylesheet" href="../CSS/footer.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Chivo:ital,wght@1,200&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="../JS/javascript.js"></script>
  <!--THIS IS STYLE FOR TABLE-->
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
    .admin-container {
    position: relative; /* Set position to relative */
    display: flex; /* Ensure the child elements are displayed in a row */
}

.reservation-display, .message-display {
    position: absolute; /* Set position to absolute */
    top: 0; /* Adjust as needed */
    left: 250px; /* Adjust based on the width of the admin panel */
    height: auto; /* Expand to full height */
    width: calc(100% - 250px); /* Adjust width to fill remaining space */
}
    .admin-panel {
        left: 0;
        width: 250px; /* Adjust width as needed */
        height: 100vh;
        background-color: lightgray;
        padding: 20px;
        z-index: 1000; /* Ensure it's above other elements */
    }
    .admin-panel h3 {
      margin-top: 0;
      padding:20px;
    }
    .admin-panel a {
      display: block;
      margin-bottom: 10px;
      padding:20px;
      text-decoration: none;
    }
    
  </style>
</head>

<body>
<!-- Menubar -->
<div class="header">
  <a href="./index.html" class="logo">
    <img src="../images/HaMatata Logo - White with Black Background - 5000x5000.png" alt="CompanyLogo">
    <div class="header-right"  id="myTopnav">
    <a href="./index.html" class="active">Home</a>
    <a href="./about.html">About</a>
    <a href="./location.html">Location</a>
    <a href="./menu.html">Menu</a>
    <a href="./reservation.html">Reservation</a>
    <a href="./contact.html">Contact</a>
    <a href="./login.html">Log out</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>
<div class="admin-container">
    <div class="admin-panel" >
        <h3>Admin Panel</h3>
        <a href="#" onclick="toggleDisplay('reservation-display')">Reservation</a>
        <a href="#" onclick="toggleDisplay('message-display')">Message</a>
    </div>

    <!--Reservation Table -->   
    <div class="reservation-display" style="display: none;">
    <table>
        <tr>
            <th>Name</th>
            <th>Guests</th>
            <th>Date</th>
            <th>Special Request</th>
            <th>Place </th>
        </tr>
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

        // Query reservation data
        $sql = "SELECT * FROM reservations";
        $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["guests"] . "</td>";
                    echo "<td>" . $row["date_time"] . "</td>";
                    echo "<td>" . $row["special_requests"] . "</td>";
                    echo "<td>" . $row["place"] . "</td>";
                
                }
            } else {
                echo "<tr><td colspan='5'>No reservations found</td></tr>";
            }

        ?>

    </table>

    </div>
 
    <!--Message Table -->
    <div class="message-display" style="display: none;">
        <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
        </tr>
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

        // Query reservation data
        $sql = "SELECT * FROM contacts";
        $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["message"] . "</td>";                
                }
            } else {
                echo "<tr><td colspan='3'>No contacts found</td></tr>";
            }

        ?>

        </table>
    </div>
</div>

<!-- Javascript to click to display database -->
<script>
    function toggleDisplay(elementID) {
    var element = document.querySelector('.' + elementID);
    var others = document.querySelectorAll('.reservation-display, .message-display');
    if (element.style.display === "none") {
        // Hide all others before showing the clicked element
        others.forEach(function (el) {
            el.style.display = 'none';
        });
        element.style.display = 'flex';
    } else {
        element.style.display = 'none';
    }
}

</script>

</body>
</html>
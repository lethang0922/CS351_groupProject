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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
  
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
   
    /* Ensure proper layout with flexbox */
    .admin-container {
        display: flex;
    }

    /* Adjust admin panel width and position */
    .admin-panel {
        width: 250px;
        padding: 20px;
    }

    /* Adjust reservation display width */
    .reservation-display, .message-display {
        flex: 1;
        padding: 20px;
    }

  
    .admin-panel h3 {
    margin-top: 0;
    padding:20px;
    text-align: center;
    font-weight: bold;
    }
    .admin-panel a {
    display: block;
    margin-bottom: 10px;
    padding:20px;
    text-decoration: none;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  
  }   

  /* Add custom styling for DataTables */
  </style>
</head>

<body>
<!-- Menubar -->
<div class="header">
  <a href="../html/index.html" class="logo">
    <img src="../images/HaMatata Logo - White with Black Background - 5000x5000.png" alt="CompanyLogo">
  </a> 
</div>
<div class="admin-container">
    <div class="admin-panel" >
        <h3>Admin Panel</h3>
        <a href="#" onclick="toggleDisplay('reservation-display')">Reservation</a>
        <a href="#" onclick="toggleDisplay('message-display')">Message</a>
        <a href="../admin/login.html" >Logout</a>

    </div>

    <!--Reservation Table -->   
    <div class="reservation-display" section="reservationdisplay" >
    <table id="myTable">
      <thead>
        <tr>
            <th>Reservation_ID</th>
            <th>Name</th>
            <th>Guests</th>
            <th>Date</th>
            <th>Special Request</th>
            <th>Place </th>
            <th> </th>
            <th> </th>
        </tr>
      </thead>
      <tbody>
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
                    echo "<tr>" ;
                    echo "<td>" . $row["reservation_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["guests"] . "</td>";
                    echo "<td>" . $row["date_time"] . "</td>";
                    echo "<td>" . $row["special_requests"] . "</td>";
                    echo "<td>" . $row["place"] . "</td>";
                    echo "<td><form method='post' action='delete.php'>
                          <input type='hidden' name='reservation_id' value='" . $row["reservation_id"] . "'>
                          <input type='submit' value='Delete'></form></td>";
                    echo "<td><form method='post' action='edit_form.php'>
                          <input type='hidden' name='edit_id' value='" . $row["reservation_id"] . "'>
                          <input type='submit' name ='edit_btn'value='Edit'></form></td>";
                    echo "</tr>";   
                }
            } else {
                echo "<tr><td colspan='5'>No reservations found</td></tr>";
            }

        ?>
      </tbody>
    </table>

    </div>
 
    <!--Message Table -->
    <div class="message-display" section="messageDisplay"style="display: none; width:100%">
        <table id="myTable2" style="width:100%" >
        <thead style="width:100%">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Title</th>
            <th>Message</th>
          </tr>
        </thead>

        <tbody style="width:100%">
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
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["message"] . "</td>";                
                }
            } else {
                echo "<tr><td colspan='3'>No contacts found</td></tr>";
            }

        ?>
        </tbody>
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

 <!-- Include DataTables JavaScript and initialize -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
 <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#myTable2').DataTable();
        });
    </script>
</body>



</html>
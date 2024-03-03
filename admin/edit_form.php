

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
   
  h2 {
      text-align: center;
      padding: 10px;
    }

  .edit-form {
      width: 400px;
      margin-top: 50px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
    }
  .form-group {
      margin-bottom: 15px;
    }
  label {
      display: block;
      font-weight: bold;
    }
  input[type="text"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }
  input[type="submit"] {
      background-color: #333;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 3px;
    }
  input[type="submit"]:hover {
      background-color: #555;
    }
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
            <a href="../admin/admin_dashboard.php#reservationdisplay">Reservation</a>
            <a href="../admin/admin_dashboard.php#messageDisplay" onclick="toggleDisplay('message-display')">Message</a>
         <a href="../admin/login.html" >Logout</a>
    </div>

    <h2>Edit Reservation</h2>
    <?php
    $connection = mysqli_connect("localhost","root","","CS351_groupProject");
    if(isset($_POST['edit_btn'])){
        $reservation_id = $_POST['edit_id'];
        
        $query = "SELECT * FROM reservations WHERE reservation_id='$reservation_id'";
        $query_run = mysqli_query($connection, $query);

        foreach($query_run as $row){
            ?>
      

    <div class="edit-form">
    <form method="POST" action="edit.php">
        <input type="hiddem" name="edit_id" value="<?php echo $row['reservation_id']?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="edit_name" value="<?php echo $row['name']?>"><br>
        <label for="guests">Guests:</label><br>
        <input type="text" id="guests" name="edit_guests" value="<?php echo $row['guests']?>"><br>
        <label for="date_time">Date:</label><br>
        <input type="text" id="date_time" name="edit_date_time" value="<?php echo $row['date_time']?>"><br>
        <label for="special_requests">Special Requests:</label><br>
        <input type="text" id="special_requests" name="edit_special_requests" value="<?php echo $row['special_requests']?>"><br>
        <label for="place">Place:</label><br>
        <input type="text" id="place" name="edit_place" value="<?php echo $row['place']?>"><br><br>
        <button type="submit" name="updatebtn">Update </button>
        <a href="../admin/admin_dashboard.php#reservationdisplay">Cancel</a>
    </form>
    </div>
    <?php
        }
    }
    ?>
</body>
</html>
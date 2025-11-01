<?php
//Linking the configuration file
require ('php/config.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Employee'){
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Complaint Form</title>
    <link rel="stylesheet" href="style/complain.css"> <!-- Link to the CSS file -->
</head>
<body>
    <?php 
        include ('php/header.php')
    ?>
    <div class="complain">
    <h2>Submit Your Complaint</h2>
    <form id="complaintForm" action="<?php $_SERVER["PHP_SELF"]?>" method="post">
    <label for="emp_id">Complain No:</label>
    <input type="text" id="emp_id" name="C_no" placeholder="Enter your Employee ID" required>

    <label for="emp_id">Employee ID:</label>
    <input type="text" id="emp_id" name="emp_id" placeholder="Enter your Employee ID" required>

    <label for="emp_email">Employee Email:</label>
    <input type="email" id="emp_email" name="emp_email" placeholder="Enter your Email" required>

    <label for="c_title">Complaint Title:</label>
    <input type="text" id="c_title" name="c_title" placeholder="Enter Complaint Title" required>

    <label for="complaint_date">Date of Incident:</label>
    <input type="date" id="complaint_date" name="complaint_date" required>

    <label for="c_detail">Complaint Details:</label>
    <textarea id="c_detail" name="c_detail" rows="5" placeholder="Enter the details of your complaint" required></textarea>

    <div id="errorMessage" class="error"></div>
    <div id="successMessage" class="success"></div>

    <button type="submit" name="submit">Submit Complaint</button>
</form>

    </div>

    <script src="script/complain.js"></script> <!-- Link to the JavaScript file -->
    <?php 
        include ('php/footer.php')
    ?>
</body>
</html>
<?php

if(isset($_POST["submit"])){

    // Sanitize inputs
    $C_No = $_POST["C_no"];
    $emp_id =$_POST["emp_id"];
    $emp_email = $_POST["emp_email"]; // Use FILTER_SANITIZE_EMAIL for emails
    $complaint_date =$_POST["complaint_date"];
    $c_title = $_POST["c_title"];
    $c_detail = $_POST["c_detail"];
    // Prepare SQL query
    $sql = "INSERT INTO complaint (C_No,C_ID, C_Email,C_Date, C_Title, C_Details)
            VALUES ('$C_No','$emp_id', '$emp_email', '$complaint_date','$c_title', '$c_detail')";

    // Execute query
    if($conn->query($sql) === TRUE) {
        echo "Inserted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

    
?>

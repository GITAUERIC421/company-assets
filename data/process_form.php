<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script></script>
    <?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deped";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming user input is stored in a variable $user_emp_id
$emp_id = $_POST['emp_id']; // Replace with your actual way of getting user input

// Prepare and bind the SQL statement
$sql = "SELECT emp_fname, emp_mname, emp_lname FROM tbl_employee WHERE emp_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $emp_id);

// Execute the query
$stmt->execute();

// Bind the result variables
$stmt->bind_result($emp_fname, $emp_mname, $emp_lname);

// Fetch the result
$stmt->fetch();

// Output the result
if ($stmt->num_rows > 0) {
    echo "First Name: $emp_fname<br>";
    echo "Middle Name: $emp_mname<br>";
    echo "Last Name: $emp_lname<br>";
} else {
    echo "No matching record found for emp_id: $emp_id";
}

// Close statement and connection
$stmt->close();
$conn->close();

?>




</body>
</html>
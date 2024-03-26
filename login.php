<?php
session_start();
header("Access-Control-Allow-Origin: *");

// Allow specified methods
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Allow specified headers
header("Access-Control-Allow-Headers: Content-Type");

// Set response content type
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assuming you have a database connection
    // Replace 'your_database_credentials' with actual values
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "OilLevel";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve username and password from the Ajax request
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    $row=mysqli_fetch_assoc($result);
    $_SESSION['phone']=$row['phone'];
    if ($result->num_rows > 0) {
        // Login successful
        echo json_encode(["status" => "success", "message" => "Login successful!"]);
    } else {
        // Login failed
        echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
    }

    $conn->close();
} else {
    // Handle non-POST requests
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>

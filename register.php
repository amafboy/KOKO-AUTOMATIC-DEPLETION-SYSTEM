<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your database connection code (modify it with your actual credentials)
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

    // Fetch data from the form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password =$_POST["password"];
    $phone=$_POST['phone'];

    // Insert data into the database
    $sql = "INSERT INTO users (name, email, username, password,phone) VALUES ('$name', '$email', '$username', '$password','$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

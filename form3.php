<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $stmt = $conn->prepare("SELECT report FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($report);
    $stmt->fetch();
    $stmt->close();

    
    header("Content-type: application/pdf");
    echo $report;
}

$conn->close();
?>

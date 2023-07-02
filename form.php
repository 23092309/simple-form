<?php
  // Database connection
  $servername = "localhost";
  $username = "your_username
  $password = "your_password";
  $database = "your_database";
  
  $conn = new mysqli($servername, $username, $password, $database);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $age = $_POST["age"];
      $weight = $_POST["weight"];
      $email = $_POST["email"];
      $report = $_FILES["report"];
  
      
      $stmt = $conn->prepare("INSERT INTO users (name, age, weight, email, report) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sisss", $name, $age, $weight, $email, $report);
      
      
      $targetDirectory = "uploads/";
      $targetFile = $targetDirectory . basename($report["name"]);
      move_uploaded_file($report["tmp_name"], $targetFile);
  
      if ($stmt->execute()) {
          echo "User details and file uploaded successfully.";
      } else {
          echo "Error: " . $stmt->error;
      }
  
      $stmt->close();
  }
  
  $conn->close();
  ?>
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obituary_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$name = $_POST['name'];
$dob = $_POST['dob'];
$dod = $_POST['dod'];
$content = $_POST['content'];
$author = $_POST['author'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO obituaries (name, dob, dod, content, author) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $dob, $dod, $content, $author);

// Execute the query
if ($stmt->execute()) {
    echo "Obituary submitted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>

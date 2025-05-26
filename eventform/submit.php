<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "event_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$event = $_POST['event'];
$date = $_POST['date'];
$venue = $_POST['venue'];

// Prepare SQL statement
$sql = "INSERT INTO registrations (name, email, phone, event, date, venue)
        VALUES (?, ?, ?, ?, ?, ?)";

// Use prepared statement for security
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $email, $phone, $event, $date, $venue);

// Execute and check
if ($stmt->execute()) {
    echo "<h2>Registration successful!</h2>";
} else {
    echo "Error: " . $stmt->error;
}

// Close
$stmt->close();
$conn->close();
?>

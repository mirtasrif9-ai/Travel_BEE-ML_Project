<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = ""; // Default for XAMPP
$dbname = "tour_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    $package = $conn->real_escape_string($_POST['package']);
    $persons = $conn->real_escape_string($_POST['persons']);
    $duration = $conn->real_escape_string($_POST['duration']);
    $travel_date = $conn->real_escape_string($_POST['travel_date']);

    // Insert data into the database
    $sql = "INSERT INTO contact_us (name, email, phone, subject, message, package, persons, duration, travel_date) 
            VALUES ('$name', '$email', '$phone', '$subject', '$message', '$package', '$persons', '$duration', '$travel_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

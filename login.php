<?php
// Database connection
$servername = "localhost";
$dbusername = "root"; // Replace with your database username
$dbpassword = "";     // Replace with your database password
$dbname = "tour_project";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Successful login
            echo "<script>alert('Login Successful!'); window.location.href='index.html';</script>";
        } else {
            // Invalid password
            echo "<script>alert('Invalid Password!'); window.location.href='login.html';</script>";
        }
    } else {
        // Username not found
        echo "<script>alert('Invalid Username!'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>

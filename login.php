<?php
$host = "localhost";
$database = "users";
$username = "david";
$password = "Meva$$eret2112";

// Establish a connection to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the submitted username and password
$usernameInput = $_POST['username'];
$passwordInput = $_POST['password'];

// Prepare and execute a SQL query to check the username and password in the users table
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $usernameInput, $passwordInput);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows == 1) {
    // Redirect to logged.html if the username and password are correct
    header("Location: logged.html");
    exit(); // Ensure that the script stops executing after the redirect
} else {
    // Redirect to home.html if the username and password are incorrect
    header("Location: home.html");
    exit(); // Ensure that the script stops executing after the redirect
}

$stmt->close();
$conn->close();
?>

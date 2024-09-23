<?php
require 'mysqli.php';

// Extract data from the form
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['pwd']);
$department = mysqli_real_escape_string($conn, $_POST['department']);

// Basic input validation (you can add more)
if (empty($name) || empty($email) || empty($password) || empty($department)) {
    // Handle validation errors (e.g., display a message or redirect)
    echo "Please fill in all required fields.";
    exit;
}

// Check if email already exists (prevent duplicates)
$checkEmailSql = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
$checkStmt = $conn->prepare($checkEmailSql);
$checkStmt->bind_param('s', $email);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$checkRow = $checkResult->fetch_assoc();

if ($checkRow['count'] > 0) {
    // Handle duplicate email (e.g., display a message)
    echo "Email already exists.";
    exit;
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO users (name, email, pwd, department) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $name, $email, $password, $department);

if ($stmt->execute()) {
    // Registration successful, redirect to login page or show a success message
    header('Location: index.php'); // Assuming index.php is your login page
    exit();
} else {
    // Handle insertion errors (e.g., display a message)
    echo "Error registering user: " . $stmt->error;
}

$stmt->close();
$conn->close();

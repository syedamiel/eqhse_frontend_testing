<?php

require 'mysqli.php';
session_start();

// Extract data from the form
$problem_statement = isset($_POST['problem_statement']) ? mysqli_real_escape_string($conn, $_POST['problem_statement']) : '';
$causal_factor_1 = isset($_POST['causal_factor_1']) ? mysqli_real_escape_string($conn, $_POST['causal_factor_1']) : '';
$rca_image_input = isset($_POST['rca_image_input']) ? mysqli_real_escape_string($conn, $_POST['rca_image_input']) : '';
$why_1 = isset($_POST['why_1']) ? mysqli_real_escape_string($conn, $_POST['why_1']) : '';
$why_2 = isset($_POST['why_2']) ? mysqli_real_escape_string($conn, $_POST['why_2']) : '';
$why_3 = isset($_POST['why_3']) ? mysqli_real_escape_string($conn, $_POST['why_3']) : '';
$why_4 = isset($_POST['why_4']) ? mysqli_real_escape_string($conn, $_POST['why_4']) : '';
$why_5 = isset($_POST['why_5']) ? mysqli_real_escape_string($conn, $_POST['why_5']) : '';
$most_probable_root_cause_1 = isset($_POST['most_probable_root_cause_1']) ? mysqli_real_escape_string($conn, $_POST['most_probable_root_cause_1']) : '';

// Basic input validation
$errors = [];
if (empty($problem_statement)) {
    $errors[] = "Please add a problem statement for the report.";
}
// Add more validation rules for other fields as needed

// If there are errors, redirect back to the form with error messages
if (!empty($errors)) {
    // Handle errors, e.g., display error messages on the form
    header("Location: ../chronology-of-findings.php?errors=" . implode(',', $errors));
    exit;
}

// Prepare SQL statement
$sql = "INSERT INTO rca (problem_statement, causal_factor_1, rca_image_input, 
        why_1, why_2, why_3, why_4, why_5, most_probable_root_cause_1)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssbssssss",
    $problem_statement,
    $causal_factor_1,
    $rca_image_input,
    $why_1,
    $why_2,
    $why_3,
    $why_4,
    $why_5,
    $most_probable_root_cause_1
);

// Execute statement and handle success/failure
if ($stmt->execute()) {
    echo "Data saved successfully!";
    header('location: ../correction.php'); //Move to approval page
    exit();
} else {
    echo "Error saving data: " . $stmt->error;
}

$stmt->close();
$conn->close();

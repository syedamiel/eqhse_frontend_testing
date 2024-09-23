<?php

require 'mysqli.php';
session_start();

// Extract data from the form
$findings_date = isset($_POST['findings_date']) ? mysqli_real_escape_string($conn, $_POST['findings_date']) : '';
$findings_time = isset($_POST['findings_time']) ? mysqli_real_escape_string($conn, $_POST['findings_time']) : '';
$findings_image_input = isset($_POST['findings_image_input']) ? mysqli_real_escape_string($conn, $_POST['findings_image_input']) : '';
$findings = isset($_POST['findings']) ? mysqli_real_escape_string($conn, $_POST['findings']) : '';

// Basic input validation
$errors = [];
if (empty($findings)) {
    $errors[] = "Please add a finding for the report.";
}
// Add more validation rules for other fields as needed

// If there are errors, redirect back to the form with error messages
if (!empty($errors)) {
    // Handle errors, e.g., display error messages on the form
    header("Location: ../chronology-of-findings.php?errors=" . implode(',', $errors));
    exit;
}

// Prepare SQL statement
$sql = "INSERT INTO chronology_of_findings (findings_date, findings_time, findings_image, findings)
VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssbs", $findings_date, $findings_time, $findings_image_input, $findings);

// Execute statement and handle success/failure
if ($stmt->execute()) {
    echo "Data saved successfully!";
    header('location: ../rca.php'); //Move to approval page
    exit();
} else {
    echo "Error saving data: " . $stmt->error;
}

$stmt->close();
$conn->close();

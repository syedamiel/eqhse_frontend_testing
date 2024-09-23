<?php

require 'mysqli.php';
session_start();

// Extract data from the form
$npt = isset($_POST['npt']) ? mysqli_real_escape_string($conn, $_POST['npt']) : '';
$logistics = isset($_POST['logistics']) ? mysqli_real_escape_string($conn, $_POST['logistics']) : '';
$repair = isset($_POST['repair']) ? mysqli_real_escape_string($conn, $_POST['repair']) : '';
$replacement = isset($_POST['replacement']) ? mysqli_real_escape_string($conn, $_POST['replacement']) : '';
$penaltyOrLd = isset($_POST['penalty-or-ld']) ? mysqli_real_escape_string($conn, $_POST['penalty-or-ld']) : '';
$others = isset($_POST['others']) ? mysqli_real_escape_string($conn, $_POST['others']) : '';

// Basic input validation
$errors = [];
if (empty($npt)) {
    $errors[] = "Please input a number.";
}
// Add more validation rules for other fields as needed

// If there are errors, redirect back to the form with error messages
if (!empty($errors)) {
    // Handle errors, e.g., display error messages on the form
    header("Location: cost-impact.php?errors=" . implode(',', $errors));
    exit;
}

// Prepare SQL statement
$sql = "INSERT INTO cost_impact (npt, logistics, repair, replacement, penalty_or_ld, others) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('dddddd', $npt, $logistics, $repair, $replacement, $penaltyOrLd, $others);

// Execute statement and handle success/failure
if ($stmt->execute()) {
    echo "Data saved successfully!";
    header('location: ../cost-impact.php'); //Move to approval page
    exit();
} else {
    echo "Error saving data: " . $stmt->error;
}

$stmt->close();
$conn->close();

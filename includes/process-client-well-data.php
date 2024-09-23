<?php

require 'mysqli.php';
session_start();

// Extract data from the form
$projectType = isset($_POST['projectType']) ? mysqli_real_escape_string($conn, $_POST['projectType']) : '';
$client = isset($_POST['client']) ? mysqli_real_escape_string($conn, $_POST['client']) : '';
$location = isset($_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location']) : '';
$nonConformity = isset($_POST['non-conformity']) ? mysqli_real_escape_string($conn, $_POST['non-conformity']) : '';
$wellServices = isset($_POST['well-services']) ? mysqli_real_escape_string($conn, $_POST['well-services']) : '';
$wellProductions = isset($_POST['well-productions']) ? mysqli_real_escape_string($conn, $_POST['well-productions']) : '';

// Basic input validation
$errors = [];
if (empty($projectType)) {
    $errors[] = "Project type is required.";
}
// Add more validation rules for other fields if needed

// If there are errors, redirect back to the form with error messages
if (!empty($errors)) {
    // Handle errors, e.g., display error messages on the form
    header("Location: client-well-information.php?errors=" . implode(',', $errors));
    exit;
}

// Prepare SQL statement
$sql = "INSERT INTO client_and_well_information (car_no, project_name, client_name, location, non_conformity, well_services, well_productions_service_solutions) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssss', $projectType, $uzmaDivision, $client, $location, $nonConformity, $wellServices, $wellProductions);

// Execute statement and handle success/failure
if ($stmt->execute()) {
    echo "Data saved successfully!";
    header('location: ../chronology-of-findings.php');
    exit();
} else {
    echo "Error saving data: " . $stmt->error;
}

$stmt->close();
$conn->close();

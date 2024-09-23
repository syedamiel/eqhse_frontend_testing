<?php

require 'mysqli.php';
require 'car-generator.php';
session_start();

// Extract data from the form
$uzmaDivision = isset($_POST['uzma-division']) ? mysqli_real_escape_string($conn, $_POST['uzma-division']) : '';
$carNo = isset($_POST['car_no']) ? mysqli_real_escape_string($conn, $_POST['car_no']) : '';
$issueDate = isset($_POST['issue_date']) ? mysqli_real_escape_string($conn, $_POST['issue_date']) : date('Y-m-d'); // Default to current date
$reporter = isset($_POST['reporter']) ? mysqli_real_escape_string($conn, $_POST['reporter']) : '';
$reporterId = isset($_POST['reporter_id']) ? mysqli_real_escape_string($conn, $_POST['reporter_id']) : 0; // Or handle it appropriately
$department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : '';

$userId = $_SESSION['user'];

$sql = "SELECT name, id FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    $reporter = $row['name'];
    $reporterId = $row['id'];
} else {
    // Handle error if user not found
    $reporter = "Unknown";
    $reporterId = 0; // Or handle it appropriately
}


// check if draft or proceed
$status_id = 1;
$today = date("Y-m-d");


// Prepare SQL statement
$sql = "INSERT INTO car_general_details (division, car_no, issue_date, reporter, reporter_id, department, status_id, createdBy, createdDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssssss', $uzmaDivision, $carNo, $issueDate, $reporter, $reporterId, $department, $status_id, $_SESSION['user'], $today);

updateRunningNo($uzmaDivision);

// Execute statement and handle success/failure
if ($stmt->execute()) {
    echo "Data saved successfully!";
    if ($status_id == 0) {
        header('location: ../new-car.php');
    }
    header('location: ../client-well-information.php?car_no=' . $carNo);
    exit();
} else {
    echo "Error saving data: " . $stmt->error;
}

$stmt->close();
$conn->close();

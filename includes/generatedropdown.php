<?php

require 'mysqli.php';

if (isset($_GET['dropdownType'])) {
    $dropdownType = $_GET['dropdownType'];

    if ($dropdownType == 'company') {
        getCompany($conn);
    } elseif ($dropdownType == 'department') {
        getDepartment($conn);
    }
}

function getCompany($conn)
{
    $query = "SELECT company_code, company_name FROM tbl_company";
    $result = $conn->query($query);
    $company = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $company[] = $row;
        }
    }

    echo json_encode($company);
}

function getDepartment($conn)
{
    $query = "SELECT dept_code, dept_name FROM tbl_department";
    $result = $conn->query($query);
    $department = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $department[] = $row;
        }
    }

    echo json_encode($department);
}

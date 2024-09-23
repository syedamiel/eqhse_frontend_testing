<?php


if (isset($_POST['selectedValue'])) {
    session_start();
    $userId = $_SESSION['user'];
    $company = $_POST['selectedValue'];
    // return $company;
    $carNoCompany = generateRunningNo($company);
    $userName = getReporter($userId);
    $_SESSION['carNo'] = $carNoCompany;

    echo $carNoCompany . "|" . $userName . "|" . date("Y-m-d");
}

function generateRunningNo($company)
{

    require 'mysqli.php';

    $query = "SELECT car_running_no FROM tbl_company WHERE company_code = '$company'";
    // return $query;
    $result = $conn->query($query);
    $num_rows = $result->num_rows;
    // return $num_rows;

    if ($num_rows > 0) {
        $row = $result->fetch_assoc();
        $item_no = $row['car_running_no'];
        if ($item_no > 0) {
            $newNumber = $item_no + 1;
            $runningNo = str_pad($newNumber, 3, 0, STR_PAD_LEFT); // CAR-UZEN-20240906001
            $carNo = "CAR-$company-" . date("Ymd") . "-" . $runningNo;
        } else {
            $carNo = "CAR-$company-" . date('Ymd') . "-" . "01";
        }
    } else {
        $carNo = "CAR-$company-" . date('Ymd') . "-" . "01xx";
    }

    return $carNo;
}

function getMaxRunningNo($company)
{

    require 'mysqli.php';

    $query = "SELECT MAX(car_running_no) as 'car_running_no' FROM tbl_company WHERE company_code ='$company'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $runningNo = $row['car_running_no'];

    return $runningNo;
}

function updateRunningNo($company)
{

    require 'mysqli.php';
    $maxNo = getMaxRunningNo($company) + 1;
    $query = "UPDATE tbl_company SET car_running_no = $maxNo WHERE company_code = '$company'";
    $conn->query($query);
}

function getReporter($userId)
{
    require 'mysqli.php';
    $sql = "SELECT name FROM users WHERE id = $userId";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userName = $row['name'];
    } else {
        // Handle error if user not found (optional)
    }

    return $userName;
}

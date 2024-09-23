<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "eqhse_corrective_action_reports";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

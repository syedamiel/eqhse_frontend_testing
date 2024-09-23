<?php
require 'mysqli.php';
$email = $_POST['email'];
$pwd = $_POST['pwd'];

//to prevent from mysqli injection  
$email = stripcslashes($email);
$pwd = stripcslashes($pwd);
$email = mysqli_real_escape_string($conn, $email);
$pwd = mysqli_real_escape_string($conn, $pwd);

$sql = "SELECT * from users where email = '$email' and pwd = '$pwd'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $password = $row['pwd'];
    $password_verify = password_verify($pwd, $password);

    if (!$password_verify) {
        $errorMsg = "Invalid email or password.";
        echo "Incorrect login information. Please go back and try again.";
        exit();
    }

    // Successful login, start a session and redirect to dashboard
    session_start();
    $_SESSION['user'] = $row['id']; // Assuming 'id' is the user's unique identifier
    header('location: ../dashboard.php');
    exit();
} else {
    // Login failed, display error message
    $errorMsg = "Invalid email or password.";
    echo "Incorrect login information. Please go back and try again.";
}

<?php
session_start();

require_once 'dbh-inc.php';

if (isset($_POST['login'])) {
    // Escape user input to prevent SQL injection
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pwd = $_POST['pwd'];

    // Hash password before comparison
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM `users` WHERE `email`=? ";
    $query = $conn->prepare($sql);
    $query->execute(array($email));
    $row = $query->rowCount();
    $fetch = $query->fetch();

    if ($row > 0) {
        // Verify password using password_verify
        if (password_verify($pwd, $fetch['pwd'])) {
            $_SESSION['user'] = $fetch['id'];
            header("location: dashboard.php");
        } else {
            echo "
          <script>alert('Invalid email or password')</script>
          <script>window.location = 'index.php'</script>
        ";
        }
    } else {
        echo "
        <script>alert('Invalid email or password')</script>
        <script>window.location = 'index.php'</script>
      ";
    }
}

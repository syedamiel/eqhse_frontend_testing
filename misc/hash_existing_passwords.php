<?php
require_once('includes/dbh-inc.php'); // Include connection details

// Fetch all users
$sql = "SELECT id, pwd FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    // Check if the password is already hashed (assuming that a hashed password starts with "$2y$")
    if (strpos($user['pwd'], '$2y$') !== 0) {
        // Hash the existing password
        $hashedPassword = password_hash($user['pwd'], PASSWORD_DEFAULT);

        // Update the user's password in the database
        $updateSql = "UPDATE users SET pwd = :pwd WHERE id = :id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindValue(':pwd', $hashedPassword);
        $updateStmt->bindValue(':id', $user['id']);
        $updateStmt->execute();
    }
}

echo "Existing passwords have been hashed successfully.";

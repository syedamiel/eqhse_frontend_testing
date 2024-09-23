<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh-inc.php';
        require_once 'login-model-inc.php';
        require_once 'login-control-inc.php';

        //ERROR HANDLERS
        $errors = [];

        if (is_input_empty($email, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($conn, $email);

        if (is_email_wrong($result)) {
            $errors["email_wrong"] = "Email not in database!";
        }

        if (!is_email_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect password!";
        }

        require_once 'config-session-inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);

        $_SESSION["last_regeneration"] = time();

        header("Location: ../index.php?login=success");
        $conn = null;
        $statement = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}

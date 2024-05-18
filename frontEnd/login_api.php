<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a connection
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_salt = "SELECT salt, password, api_key FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql_salt);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $stmt->bind_result($salt, $stored_hash, $api_key);
    $stmt->fetch();
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    if ($salt && $stored_hash) {
        $password = $salt . $password;

        if (password_verify($password, $stored_hash)) {
            session_start();
            $_SESSION['api_key'] = $api_key;

            echo "Login successful. API Key: " . $api_key;
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "Invalid request method.";
}
?>

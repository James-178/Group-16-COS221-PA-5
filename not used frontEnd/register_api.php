<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 检查所有字段是否已填写
    if (empty($first_name) || empty($last_name) || empty($dob) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // 检查字符长度
    if (strlen($first_name) > 50 || strlen($last_name) > 50 || strlen($email) > 50 || strlen($password) > 55) {
        echo "Character length exceeded.";
        exit;
    }

    // 验证电子邮件格式
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid Email.";
        exit;
    }

    // 验证密码强度
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9\s]).{8,}$/', $password)) {
        echo "Invalid Password.";
        exit;
    }

    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_check_email = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql_check_email);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($count > 0) {
        echo "Email already registered.";
        exit;
    }

    $salt = bin2hex(random_bytes(10));
    $salted_password = $salt . $password;
    $hashed_password = password_hash($salted_password, PASSWORD_BCRYPT);

    do {
        $api_key = bin2hex(random_bytes(10));
        $sql = "SELECT COUNT(api_key) AS count FROM users WHERE api_key = '$api_key'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    } while ($row['count'] > 0);

    $sql = "INSERT INTO users (first_name, last_name, dob, email, salt, password, api_key) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $dob, $email, $salt, $hashed_password, $api_key);

    if ($stmt->execute()) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>

<?php
include_once "conn.php";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form inputs
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Basic validation
    if ($password !== $confirm_password) {
        header("Location: register.php?error=Passwords+do+not+match");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $isAdmin = 0;
    $isActive = 1;

    // Prepare and execute insert query
    $sql = "INSERT INTO users (firstName, lastName, email, password, address, isAdmin, isActive) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssii", $firstName, $lastName, $email, $hashedPassword, $address, $isAdmin, $isActive);
        if ($stmt->execute()) {
            header("Location: login.php?success=Registration+successful!+You+can+now+log+in");
            exit();
        } else {
            header("Location: register.php?error=Database+error:+" . urlencode($stmt->error));
            exit();
        }
    } else {
        header("Location: register.php?error=Database+error:+" . urlencode($conn->error));
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}

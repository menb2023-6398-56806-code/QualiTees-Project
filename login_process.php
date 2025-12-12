<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    $email = mysqli_real_escape_string($conn, $email);

    // Query only the user by email
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {

            if ($row['isActive'] == 0) {
                echo "<script>alert('Your account is inactive.'); window.location.href='login.php';</script>";
                exit();
            }

            // SESSION data
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
            $_SESSION['firstname'] = $row['firstName'];
            $_SESSION['lastname']  = $row['lastName'];
            $_SESSION['address']  = $row['address'];
            $_SESSION['isAdmin'] = $row['isAdmin'];
            if ($row['isAdmin'] == 1) {
                header("Location: ./admin.php");
            } else {
                header("Location: ./homepage.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid email or password'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password'); window.location.href='login.php';</script>";
    }
}

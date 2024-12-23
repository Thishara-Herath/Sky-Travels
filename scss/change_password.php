<?php
session_start();
require 'dbconn.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the admin is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: admin_login.php');
        exit();
    }

    $email = $_SESSION['email'];
    $new_password = $_POST['new_password'];

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
    $stmt->bind_param('ss', $new_password, $email);
    $stmt->execute();

    // Check if the password update was successful
    if ($stmt->affected_rows > 0) {
        // Password changed successfully, send a success message
        echo "<script>
            alert('Password changed successfully!');
            window.location.href = 'admin_dashboard.php';  // Stay on the same page
        </script>";
    } else {
        echo "<script>
            alert('Password change failed. Please try again.');
            window.location.href = 'admin_dashboard.php';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

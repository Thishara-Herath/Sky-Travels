<?php
session_start();
include('dbconn.php');

// Ensure the user is logged in
if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id']) || empty($_POST['message'])) {
    echo "Invalid request.";
    exit();
}

// Get user_id and message
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // User session
    $message = $_POST['message'];
    $admin_id = NULL;  // No admin ID for user messages
} else if (isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['user_id']; // User session to reply to
    $message = $_POST['message'];
    $admin_id = $_SESSION['admin_id']; // Admin ID for admin messages
}

// Insert message into the database
if ($admin_id) {
    // Admin message (admin_id is not null)
    $sql = "INSERT INTO chats (user_id, admin_id, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $admin_id, $message);
} else {
    // User message (admin_id is null)
    $sql = "INSERT INTO chats (user_id, message) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $message);
}

$stmt->execute();

// Redirect back to the chat page
header("Location: admin_chat.php");
exit();
?>

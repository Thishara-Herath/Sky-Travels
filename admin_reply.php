<?php
session_start();
include('dbconn.php');

// Ensure the admin is logged in
if (!isset($_SESSION['admin_id']) || empty($_POST['reply'])) {
    echo "Invalid request.";
    exit();
}

$admin_id = $_SESSION['admin_id']; // Assuming admin_id is stored in session
$reply = $_POST['reply'];
$chat_id = $_POST['chat_id'];

// Update the chat message with admin reply
$sql = "UPDATE chats SET reply = ?, admin_id = ? WHERE chat_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $reply, $admin_id, $chat_id);
$stmt->execute();

// Respond back to the user
echo "Reply sent.";

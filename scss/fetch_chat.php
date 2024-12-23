<?php
session_start();
include('dbconn.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your chat history.";
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM chats WHERE user_id = ? ORDER BY created_at ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$chats = [];
while ($row = $result->fetch_assoc()) {
    $chats[] = $row;
}

// Display chat history
foreach ($chats as $chat) {
    // Check if the message is from the admin or user
    if ($chat['admin_id']) {
        // Admin message
        echo '<div><strong>Admin (' . htmlspecialchars($chat['created_at']) . '):</strong> ' . htmlspecialchars($chat['message']) . '</div>';
    } else {
        // User message
        echo '<div><strong>You (' . htmlspecialchars($chat['created_at']) . '):</strong> ' . htmlspecialchars($chat['message']) . '</div>';
    }
}
?>

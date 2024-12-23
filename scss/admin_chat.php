<?php
session_start();

// Check if admin is logged in, if not redirect to login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('dbconn.php');

// Fetch all user messages
$sql = "SELECT * FROM chats WHERE admin_id IS NULL ORDER BY created_at ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Chat</title>
</head>
<body>
    <h1>Admin Chat</h1>

    <table>
        <tr>
            <th>User</th>
            <th>Message</th>
            <th>Reply</th>
        </tr>
        <?php while ($chat = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($chat['user_id']); ?></td>
                <td><?php echo htmlspecialchars($chat['message']); ?></td>
                <td>
                <form action="send_message.php" method="POST">
    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin_id']; ?>">
    <input type="hidden" name="user_id" value="<?php echo $chat['user_id']; ?>">
    <textarea name="message" placeholder="Enter your reply..."></textarea>
    <button type="submit">Send Reply</button>
</form>

                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

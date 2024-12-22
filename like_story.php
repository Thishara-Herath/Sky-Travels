<?php
include 'dbconn.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$story_id = $_POST['story_id'];

// Check if the user already liked the story
$query = "SELECT id FROM story_likes WHERE user_id = ? AND story_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $story_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Unlike the story
    $delete_query = "DELETE FROM story_likes WHERE user_id = ? AND story_id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("ii", $user_id, $story_id);
    $delete_stmt->execute();

    // Decrement like count
    $update_query = "UPDATE traveler_stories SET likes = likes - 1 WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("i", $story_id);
    $update_stmt->execute();
} else {
    // Like the story
    $insert_query = "INSERT INTO story_likes (user_id, story_id) VALUES (?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("ii", $user_id, $story_id);
    $insert_stmt->execute();

    // Increment like count
    $update_query = "UPDATE traveler_stories SET likes = likes + 1 WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("i", $story_id);
    $update_stmt->execute();
}

header("Location: display_stories.php");
exit();
?>

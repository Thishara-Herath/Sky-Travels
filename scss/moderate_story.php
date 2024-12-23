<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']); // Sanitize input
    $action = $_POST['action'];

    $status = $action === 'approve' ? 'approved' : ($action === 'reject' ? 'rejected' : null);

    if ($status) {
        $stmt = $conn->prepare("UPDATE traveler_stories SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Story $status successfully!');
                    window.location.href = 'admin_moderation.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating record: " . $stmt->error . "');
                    window.location.href = 'admin_moderation.php';
                  </script>";
        }
        $stmt->close();
    }
}
?>

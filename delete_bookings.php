<?php
// Include the db_connection.php file
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_booking'])) {
    // Get the flight ID from the form
    $flight_id = $_POST['flight_id'];

    // Prepare the SQL statement for deletion
    $sql = "DELETE FROM flights WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Execute the statement
    if ($stmt->execute([$flight_id])) {
        // Deletion successful, redirect back to view_bookings.php
        header('Location: view_bookings.php?msg=Flight booking deleted successfully');
    } else {
        // Deletion failed, handle the error
        echo "Error deleting flight booking.";
    }
} else {
    // Redirect if accessed directly without POST request
    header('Location: view_bookings.php');
    exit();
}
?>
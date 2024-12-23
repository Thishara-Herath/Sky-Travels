<?php
require 'dbconn.php'; // Include the database connection file

session_start(); // Start session to get the logged-in user's details

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID from the session

// Fetch booking history from the database for the specific user
$query = "SELECT * FROM flight_bookings WHERE user_id = ? ORDER BY booking_date DESC"; 
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$bookings = $stmt->get_result();

// Check if there are any bookings
if ($bookings->num_rows > 0) {
    $booking_history = [];
    while ($row = $bookings->fetch_assoc()) {
        $booking_history[] = $row; // Store each booking in an array
    }
} else {
    $booking_history = [];
}

?>

<?php
    require 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sky Travels</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="admin_img/icons/icon.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5">
        <div class="container"><br><br>
            <h1 class="display-3 mb-4">Booking History</h1>
            <p>Review your previous flight bookings.</p>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Booking History Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <?php if (count($booking_history) > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Flight Number</th>
                            <th>Booking Date</th>
                            <th>Payment Status</th>
                            <th>Total Amount</th>
                            <th>Reference Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($booking_history as $booking): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($booking['flight_id']); ?></td>
                                <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                                <td><?php echo htmlspecialchars($booking['payment_status']); ?></td>
                                <td>LKR<?php echo number_format($booking['total_amount'] / 100, 2); ?></td>
                                <td><?php echo htmlspecialchars($booking['reference_number']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No booking history found.</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Booking History End -->

    <?php
    require 'footer.php';
?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>

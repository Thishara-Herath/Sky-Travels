<?php
session_start();
require 'vendor/autoload.php'; // Include Stripe's PHP library (if needed)
include 'dbconn.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view your payment history.");
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Query to get the payment history for the logged-in user
$sql = "SELECT payments.id, packages.title, payments.reference_number, payments.payment_status, payments.created_at 
        FROM payments
        JOIN packages ON payments.package_id = packages.id
        WHERE payments.user_id = ? ORDER BY payments.created_at DESC";

$stmt = $conn->prepare($sql);

// Check if the prepare() method failed
if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
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
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php require "header.php"; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container"><br><br>
            <h1 class="display-3 mb-4 animated slideInDown">Payment History</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment History</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Payment History Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Payment History Table -->
                <div class="col-lg-12 wow fadeIn" data-wow-delay="0.1s">
                    <h2 class="display-6 mb-4">Your Payment History</h2>
                    <?php
                    // Check if there are any payment records for the user
                    if ($result->num_rows > 0) {
                        echo "<table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Package</th>
                                        <th>Reference Number</th>
                                        <th>Status</th>
                                        <th>Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        // Loop through and display the payments
                        while ($payment = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($payment['title']) . "</td>
                                    <td>" . htmlspecialchars($payment['reference_number']) . "</td>
                                    <td>" . htmlspecialchars($payment['payment_status']) . "</td>
                                    <td>" . date('Y-m-d H:i:s', strtotime($payment['created_at'])) . "</td>
                                  </tr>";
                        }

                        echo "</tbody></table>";
                    } else {
                        echo "<p class='alert alert-info'>You have no payment history yet.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment History End -->

    <?php require "footer.php"; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the prepared statement
$stmt->close();
// Close the database connection
$conn->close();
?>

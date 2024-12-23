<?php 
require 'vendor/autoload.php'; // Stripe PHP Library
require 'dbconn.php'; // Database connection

\Stripe\Stripe::setApiKey('sk_test_51QMuYFJe30qo7CZJWcBRebBPSRqQo2emwtLYQvLIXHpabwIB9h1dM5rSyy9j7hTPCKuQ0hpkHsRlsewyMUThEivN00fxKAt3ez'); // Replace with your secret key

session_start(); // Start the session to access logged-in user's data

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to make a payment.");
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID from session

$flight_id = isset($_GET['flight_id']) ? intval($_GET['flight_id']) : 0;
$total_price = isset($_GET['total_price']) ? intval($_GET['total_price']) * 100 : 0; // Convert to cents

// Query flight details from the database
$query = "SELECT * FROM flights WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $flight_id);
$stmt->execute();
$flight = $stmt->get_result()->fetch_assoc();

if (!$flight) {
    die("Invalid flight.");
}

try {
    // Create a new Stripe Checkout session
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => $flight['flight_no']],
                'unit_amount' => $total_price,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/Sky_Travels/Sky_Travels/flight_booking_payment.php?flight_id=' . $flight_id . '&payment_status=success&session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/Sky_Travels/Sky_Travels/payment_cancelled.php',
    ]);
} catch (Exception $e) {
    die("Error creating session: " . $e->getMessage());
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
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">

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
            <h1 class="display-3 mb-4">Booking Details</h1>
            <p>Review the flight details and proceed with your booking.</p>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Payment Information Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1>Payment for Flight <?php echo htmlspecialchars($flight['flight_no']); ?></h1>
            <p>Total Price: $<?php echo number_format($total_price / 100, 2); ?></p>
            
            <?php if (isset($_GET['payment_status']) && $_GET['payment_status'] == 'success' && isset($_GET['session_id'])): ?>
                <?php
                $session_id = $_GET['session_id'];
                
                // Fetch session details from Stripe API to verify payment status
                $session = \Stripe\Checkout\Session::retrieve($session_id);
                
                if ($session->payment_status == 'paid') {
                    // Payment is successful, update the database
                    $payment_status = 'completed'; // Set payment status to 'completed'
                    $total_amount = $session->amount_total; // Get the total amount from the Stripe session (in cents)
                    
                    // Generate reference number (you can also use a more custom format)
                    $reference_number = "REF" . time() . rand(1000, 9999); // Example: REF<timestamp><random number>
                    
                    // Prepare query to insert flight booking with logged-in user ID
                    $query = "INSERT INTO flight_bookings (flight_id, user_id, payment_status, total_amount, reference_number) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("iiiss", $flight_id, $user_id, $payment_status, $total_amount, $reference_number);
                    
                    if ($stmt->execute()) {
                        // Insert was successful, now update payment status to completed
                        $last_inserted_id = $stmt->insert_id; // Get the last inserted booking ID
                        
                        // Update the payment status to 'completed' (if not already done)
                        $update_query = "UPDATE flight_bookings SET payment_status = 'completed' WHERE id = ?";
                        $update_stmt = $conn->prepare($update_query);
                        $update_stmt->bind_param("i", $last_inserted_id);
                        $update_stmt->execute();
                        
                        // Payment was successful, show reference number and success message
                        echo "<script>alert('Payment successful! Your flight booking is confirmed. Reference Number: $reference_number');</script>";
                    } else {
                        echo "<script>alert('Error saving payment details.');</script>";
                    }
                } else {
                    echo "<script>alert('Payment failed.');</script>";
                }
                ?>
            <?php else: ?>
                <button id="checkout-button">Confirm</button>
            <?php endif; ?>
        </div>
    </div>
    <!-- Payment Information End -->

    <?php
    require 'footer.php';
?>

    <!-- JavaScript Libraries -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var stripe = Stripe('<?php echo "pk_test_51QMuYFJe30qo7CZJcvpr7BmPCmWlylrVNyacWxWNojSxCS8kalURUITh0bXLmzFO4KqQ5KB5cACfQ4MUhfYe1fpN00po4GlDVl"; ?>'); // Replace with your publishable key
        document.getElementById('checkout-button').addEventListener('click', function () {
            stripe.redirectToCheckout({ sessionId: '<?php echo $session->id; ?>' });
        });
    </script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>

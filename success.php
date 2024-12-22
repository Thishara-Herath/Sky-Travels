<?php
require 'vendor/autoload.php'; // Include Stripe's PHP library
include 'dbconn.php'; // Include database connection

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set Stripe API key
\Stripe\Stripe::setApiKey('sk_test_51QMuYFJe30qo7CZJWcBRebBPSRqQo2emwtLYQvLIXHpabwIB9h1dM5rSyy9j7hTPCKuQ0hpkHsRlsewyMUThEivN00fxKAt3ez');

// Get session_id and package_id
$session_id = isset($_GET['session_id']) ? $_GET['session_id'] : null;
$package_id = isset($_GET['package_id']) ? $_GET['package_id'] : null;

if (!$session_id || !$package_id) {
    die("Invalid payment details.");
}

try {
    // Retrieve Stripe session
    $session = \Stripe\Checkout\Session::retrieve($session_id);

    $customer_name = $session->customer_details->name ?? 'Unknown';
    $email = $session->customer_details->email ?? 'Unknown';
    $amount = $session->amount_total / 100; // Convert cents to dollars
    $payment_date = date('Y-m-d H:i:s');
    $payment_status = $session->payment_status;
    $transaction_id = $session->payment_intent;

    // Only save if payment is successful
    if ($payment_status === 'paid') {
        $sql = "INSERT INTO payments (package_id, customer_name, email, amount, payment_date, payment_status, transaction_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issdsss", $package_id, $customer_name, $email, $amount, $payment_date, $payment_status, $transaction_id);

        if ($stmt->execute()) {
            // Redirect to a thank-you message after saving payment
            header("Location: thank_you.php?name=" . urlencode($customer_name) . "&amount=" . urlencode($amount));
            exit();
        } else {
            echo "Error saving payment details: " . $stmt->error;
        }
    } else {
        echo "Payment not completed. Status: " . $payment_status;
    }
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error retrieving Stripe session: " . $e->getMessage();
}
?>

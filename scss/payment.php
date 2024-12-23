<?php
require 'vendor/autoload.php'; // Include Stripe's PHP library
include 'dbconn.php'; // Include your database connection

// Set Stripe API key
\Stripe\Stripe::setApiKey('sk_test_51QMuYFJe30qo7CZJWcBRebBPSRqQo2emwtLYQvLIXHpabwIB9h1dM5rSyy9j7hTPCKuQ0hpkHsRlsewyMUThEivN00fxKAt3ez');

// Get package details
$package_id = isset($_GET['package_id']) ? $_GET['package_id'] : null;
$priceLKR = isset($_GET['price']) ? $_GET['price'] : null;

if (!$package_id || !$priceLKR) {
    die("Invalid package details.");
}

// Fetch package details from the database
$sql = "SELECT * FROM packages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $package_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Package not found.");
}

$package = $result->fetch_assoc();

// Convert LKR to USD (example rate: 1 LKR = 0.0031 USD)
$exchangeRate = 0.0031;
$priceUSD = ceil($priceLKR * $exchangeRate * 100); // Convert to cents

// Handle payment success
if (isset($_GET['payment_status']) && $_GET['payment_status'] === 'success' && isset($_GET['session_id'])) {
    $session_id = $_GET['session_id']; // Stripe session ID
    $reference_number = "REF" . strtoupper(substr(md5($session_id), 0, 8)); // Generate a reference number from session ID

    // Get the user ID (assuming the user is logged in and user ID is stored in session)
    session_start(); // Make sure the session is started
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($user_id) {
        // Store payment details in the database
        $sql = "INSERT INTO payments (user_id, package_id, reference_number, payment_status) 
                VALUES (?, ?, ?, 'completed')";

        // Prepare the query
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $package_id, $reference_number);

        if ($stmt->execute()) {
            echo "<script>alert('Payment Successful! Your reference number is: $reference_number');</script>";
        } else {
            echo "<script>alert('Error recording payment details.');</script>";
        }
    } else {
        echo "<script>alert('User not logged in. Payment details cannot be recorded.');</script>";
    }
}

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $package['title'],
                ],
                'unit_amount' => $priceUSD, // Price in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/Sky_Travels/Sky_Travels/payment.php?package_id=' . $package_id . '&price=' . $priceLKR . '&payment_status=success&session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/Sky_Travels/Sky_Travels/payment_cancelled.php',
    ]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error creating Stripe Checkout session: " . $e->getMessage();
    exit();
}
?>

<!-- Include common header -->
<?php include 'header.php'; ?>

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container"><br><br>
        <h1 class="display-3 mb-4 animated slideInDown"><b>Complete Your Payment</b></h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                
                <li class="breadcrumb-item active" aria-current="page">Payment</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mb-5 wow fadeInUp" data-wow-delay="0.3s">
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="package-details">
                <img src="img/packages/<?php echo $package['image']; ?>" alt="<?php echo $package['title']; ?>" class="img-fluid rounded">
                <div class="info">
                    <h3><?php echo $package['title']; ?></h3>
                    <p><strong>Description:</strong> <?php echo $package['description']; ?></p>
                    <p><strong>Price (LKR):</strong> <?php echo number_format($package['price'], 2); ?> LKR</p>
                    <p><strong>Price (USD):</strong> $<?php echo number_format($priceUSD / 100, 2); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="price">
                <p>Total Price: LKR <?php echo number_format($priceLKR, 2); ?> | USD $<?php echo number_format($priceUSD / 100, 2); ?></p>
                <a href="<?php echo $session->url; ?>" class="btn btn-primary py-3 px-5 mt-3">Proceed to Payment</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

<?php
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Customer';
$amount = isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : '0.00';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You!</title>
    <style>
        /* Styles for the page */
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You, <?php echo $name; ?>!</h1>
        <p>Your payment of <strong>$<?php echo number_format($amount, 2); ?></strong> was successfully processed.</p>
        <p class="details">We appreciate your purchase and hope you enjoy our services.</p>
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>

<?php
session_start();

// Check if the user is logged in before allowing checkout
if (!isset($_SESSION['user_id'])) {
    // If not logged in, store the current URL for redirection after login
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

// Continue with the checkout process if the user is logged in
$user_id = $_SESSION['user_id'];
$package_id = $_GET['package_id']; // Assuming you're passing package_id in the URL
$price = $_GET['price']; // Assuming you're passing price in the URL

// Your checkout logic here
?>

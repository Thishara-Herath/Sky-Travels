<?php
session_start();
require 'dbconn.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id FROM admin WHERE email = ? AND password = ?");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $stmt->store_result();

    // Check if a user was found
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($admin_id);
        $stmt->fetch();

        // Set session variables for the admin
        $_SESSION['admin_id'] = $admin_id; // Store admin_id in session
        $_SESSION['email'] = $email; // Store the email in session
        header('Location: admin_panel.php'); // Redirect to the admin chat page
        exit();
    } else {
        $error_message = "Invalid email or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sky Travels</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/png" href="admin_img/icons/icon.png">
</head>

<body style="background-image: url('admin_img/icons/istockphoto-1314724689-1024x1024.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center; height: 100vh; margin: 0;">

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form action="admin_login.php" method="POST">
        <h3 style="color: #003366;">Admin Sign-In</h3>

        <?php if (isset($error_message)): ?>
            <p style="color: red; text-align: center;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <label style="color: white;" for="email">Email Address</label>
        <input style="color: black; background: white;" type="email" name="email" id="email" placeholder="Enter Email Address" required>

        <label style="color: white;" for="password">Password</label>
        <input style="color: black; background: white;" type="password" name="password" id="password" placeholder="Enter Password" required>

        <button type="submit">Log In</button>

        <div class="register">
            <a style="color: #003366;" href="index.php">View Site</a></p>
        </div>

    </form>
</body>

</html>

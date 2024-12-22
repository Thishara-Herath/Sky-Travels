<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sky Travels</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="admin_img/icons/icon.png" />
</head>

<body style="background-image: url('admin_img/icons/istockphoto-1314724689-1024x1024.jpg'); background-repeat: no-repeat; background-size: 1200px; background-position: right bottom; margin: 0; height: 100vh;">

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="userlogin.php" method="POST">
        <h3 style="color: #003366;">Sign-In</h3>
        <?php
        // Display error message if set
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']); // Clear the error message after displaying
        }
        ?>
        <label style="color: white;" for="email">Email Address</label>
        <input style="color: black; background: white;" type="email" name="email" id="email" placeholder="Enter Email Address" required>
        <label style="color: white;" for="password">Password</label>
        <input style="color: black; background: white;" type="password" name="password" id="password" placeholder="Enter Password" required>
        <button type="submit">Log In</button>
        <div class="register">
            <p style="color: black">Don't have an account? <a style="color: #003366;" href="signup.php">Register</a></p>
        </div>
        <center><a href="admin_login.php" style="font-size: smaller; text-align:center; color: lightslategray;">Admin Login</center>
    </form>
</body>

</html>

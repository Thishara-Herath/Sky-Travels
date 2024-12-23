<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Sky Travels</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="icon" type="image/png" href="admin_img/icons/icon.png">
</head>

<body style="background-image: url('admin_img/icons/istockphoto-1314724689-1024x1024.jpg'); background-repeat: no-repeat; background-size: 1200px; background-position: right bottom; margin: 0; height: 100vh;">

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="register.php" method="POST">
        <h3 style="color: #003366;">Sign-Up</h3><br>
        <input style="color: black; background: white;" type="text" name="fname" id="fname" placeholder="Enter First Name" required>
        <input style="color: black; background: white;" type="text" name="lname" id="lname" placeholder="Enter Last Name" required>
        <input style="color: black; background: white;" type="text" name="mnumber" id="mnumber" placeholder="Enter Mobile Number" required>
        <input style="color: black; background: white;" type="email" name="email" id="email" placeholder="Enter Email Address" required>
        <input style="color: black; background: white;" type="password" name="password" id="password" placeholder="Enter Password" required>
        <button type="submit" value="Submit" name="submit">Sign Up</button>
        <div class="register">
            <p style="color: black">Don't have an account? <a style="color: #003366;" href="login.php">Sign In</a></p>
        </div>
    </form>
</body>

</html>
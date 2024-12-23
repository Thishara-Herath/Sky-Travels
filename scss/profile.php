<?php
session_start();
include 'dbconn.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get user details from the session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "User not found!";
    exit();
}

$user = $result->fetch_assoc();

// Handle account deletion
if (isset($_POST['delete_account'])) {
    // Delete user account from database
    $delete_sql = "DELETE FROM user WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $user_id);
    $delete_stmt->execute();

    if ($delete_stmt->affected_rows > 0) {
        // Destroy session and redirect to home page after account deletion
        session_destroy();
        header('Location: index.php');
        exit();
    } else {
        echo "Error deleting account.";
    }
}
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
    <?php require 'header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container"><br><br>
            <h1 class="display-3 mb-4 animated slideInDown">Your Profile</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Profile Section Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="display-5 mb-5 text-center">Hello, <?php echo $user['firstname']; ?>!</h1>

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- Profile Details Card -->
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>User Details</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>First Name:</strong> <?php echo $user['firstname']; ?></li>
                                <li class="list-group-item"><strong>Last Name:</strong> <?php echo $user['lastname']; ?></li>
                                <li class="list-group-item"><strong>Mobile:</strong> <?php echo $user['mobile']; ?></li>
                                <li class="list-group-item"><strong>Email:</strong> <?php echo $user['email']; ?></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Delete Account Form -->
                    <div class="text-center mt-4">
                        <p class="text-danger">Are you sure you want to delete your account? This action cannot be undone.</p>
                        <form method="POST" action="">
                            <button type="submit" name="delete_account" class="btn btn-danger">Delete Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Section End -->

    <!-- Footer Start -->
    <?php
require 'footer.php';
?>
    <!-- Footer End -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

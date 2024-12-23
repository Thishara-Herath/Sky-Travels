<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap"
        rel="stylesheet">

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

    <style>
        /* Set the initial transparent background for the header */
        .navbar {
            background-color: rgba(255, 255, 255, 0.65); /* White with transparency */
            transition: background-color 0.3s ease; /* Smooth transition effect */
        }

        .top-bar {

            background-color: rgba(255, 255, 255, 0.52); /* White with transparency */
        }

        
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-map-marker-alt text-primary me-2"></i>Sky Travels, 456 Colombo Road, Colombo, Sri Lanka</small>
                <small class="ms-4"><i class="fa fa-clock text-primary me-2"></i>9.00 am - 9.00 pm</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) : ?>
                    <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                    <span><a href="logout.php">Log Out</a></span>
                <?php else : ?>
                    <a href="signup.php"><i class="fa fa-user-plus text-primary me-2"></i>Sign Up</a>
                    <a href="login.php" class="ms-4"><i class="fa fa-user text-primary me-2"></i>Login</a>
                <?php endif; ?>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="display-5 text-primary m-0">SKY TRAVELS</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    
                    <a href="service.php" class="nav-item nav-link">Packages</a>
                    <a href="booking.php" class="nav-item nav-link">Bookings</a>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">My Account</a>
                        <div class="dropdown-menu border-light m-0">
                            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) : ?>
                                <a href="profile.php" class="dropdown-item">Profile</a>
                                <a href="booking_history.php" class="dropdown-item">Booking History</a>
                                <a href="payment_history.php" class="dropdown-item">Payment History</a>
                                <a href="review_form.php" class="dropdown-item">Add Reviews</a>
                                <a href="travel_story.php" class="dropdown-item">Add a Story</a>
                            <?php else : ?>
                                <span class="dropdown-item">Please <a href="login.php">Login</a> to access your account.</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <a href="testimonials.php" class="nav-item nav-link">Testimonials</a>
                    <a href="display_stories.php" class="nav-item nav-link">Travel Stories</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>

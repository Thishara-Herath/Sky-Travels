<?php
// Start session
session_start();

// Include your database connection
include('dbconn.php');

// Fetch all packages from the database
$sql = "SELECT * FROM packages";
$result = mysqli_query($conn, $sql);

require 'header.php';
?>

<!-- Favicon -->
<link rel="icon" type="image/png" href="admin_img/icons/icon.png">
<title>Sky Travels</title>

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap"
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

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container"><br><br>
            <h1 class="display-3 mb-4 animated slideInDown">Packages</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Packages</li>
                </ol>
            </nav>
        </div>
    </div>
<!-- Page Header End -->

<div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
    <?php while ($package = mysqli_fetch_assoc($result)) { ?>
        <div class="col-lg-4">
            <div class="nav nav-pills d-flex justify-content-between w-100 h-100 me-4">
                <!-- Button to toggle collapse of the package details -->
                <button 
                    class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapse-<?php echo $package['id']; ?>" 
                    aria-expanded="false"
                    aria-controls="collapse-<?php echo $package['id']; ?>"
                    type="button">
                    <h5 class="m-0"><i class="fa fa-bars text-primary me-3"></i><?php echo $package['title']; ?></h5>
                </button>
            </div>
        </div>
        <div class="col-lg-8">
            <!-- Collapse container that holds the details of the package -->
            <div class="collapse" id="collapse-<?php echo $package['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-6" style="min-height: 350px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute rounded w-100 h-100" src="img/packages/<?php echo $package['image']; ?>" style="object-fit: cover;" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-4"><?php echo $package['title']; ?></h3>
                        <p class="mb-4"><?php echo $package['description']; ?></p>
                        <p><i class="fa fa-check text-primary me-3"></i>Destination: <?php echo $package['destination']; ?></p>
                        <p><i class="fa fa-check text-primary me-3"></i>Duration: <?php echo $package['duration']; ?></p>
                        <p><i class="fa fa-check text-primary me-3"></i>Ideal for: <?php echo $package['ideal_for']; ?></p>
                        <p><i class="fa fa-check text-primary me-3"></i>Price: LKR <?php echo number_format($package['price'], 2); ?></p>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <!-- Show the checkout button only if the user is logged in -->
                            <a href="payment.php?package_id=<?php echo $package['id']; ?>&price=<?php echo $package['price']; ?>" class="btn btn-primary py-3 px-5 mt-3">Checkout</a>
                        <?php } else { ?>
                            <!-- Redirect to login page if not logged in -->
                            <a href="login.php" class="btn btn-primary py-3 px-5 mt-3">Login to Checkout</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php
require 'footer.php';
?>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>

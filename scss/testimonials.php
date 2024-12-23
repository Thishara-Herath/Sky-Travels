<?php
// Include the database connection file
include 'dbconn.php';

// Fetch confirmed reviews from the database
$query = "SELECT * FROM reviews WHERE confirmed = TRUE";
$result = $conn->query($query);
$confirmedReviews = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $confirmedReviews[] = $row;
    }
}
$conn->close();
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
    <?php require "header.php"; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <br><br>
            <h1 class="display-3 mb-4 animated slideInDown">Testimonials</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Testimonials Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Testimonials</p>
                    <h1 class="display-5 mb-4">What They're Saying About Us</h1>
                </div>

                <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">
                        <?php if (!empty($confirmedReviews)) : ?>
                            <?php foreach ($confirmedReviews as $review) : ?>
                                <div class="testimonial-item text-center">
                                    <p class="mb-4">
                                        <i class="fa fa-quote-left text-primary me-3"></i><?= htmlspecialchars($review['message']); ?>
                                    </p>
                                    <img class="img-fluid rounded-circle mx-auto mb-3" src="<?= htmlspecialchars($review['profile_photo']); ?>" style="width: 100px; height: 100px;" alt="">
                                    <h5 class="mb-1"><?= htmlspecialchars($review['name']); ?></h5>
                                    <p class="text-muted mb-0"><?= htmlspecialchars($review['designation']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="testimonial-item text-center">
                                <p>No testimonials found.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonials End -->

    <?php require "footer.php"; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

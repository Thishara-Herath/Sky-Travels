<?php
session_start(); // Start the session to check if the user is logged in

include("dbconn.php");

// Fetch flights from the database
$sql = "SELECT * FROM flights";
$result = $conn->query($sql);

// Check for SQL errors
if ($result === false) {
    die("SQL Error: " . $conn->error);
}

// Store the flights data
$flights = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }
}
?>

<?php
require 'header.php';
?>
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5">
    <div class="container">
        <h1 class="display-3 mb-4">Available Flights</h1>
        <p>Explore our flight options and book your journey today!</p>
    </div>
</div>
<!-- Page Header End -->

<!-- Flight Selection Section Start -->
<div class="container-xxl py-5" style="background-color: #f0f8ff;">
    <div class="container">
        <!-- Title Section -->
        <div class="text-center mx-auto mb-5">
            <h1 class="display-5 mb-4 text-primary">Select Your Flight</h1>
            <p class="lead">Choose from our range of affordable flights to suit your travel needs.</p>
        </div>

        <!-- Flight Carousel Section -->
        <?php if (!empty($flights)): ?>
            <div id="flightCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Split flights into chunks of 3
                    $chunks = array_chunk($flights, 3);
                    foreach ($chunks as $index => $chunk):
                    ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="row">
                                <?php foreach ($chunk as $flight): ?>
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card shadow-sm border-0 rounded-3">
                                            <img src="img/<?php echo htmlspecialchars($flight['image']); ?>" class="card-img-top" alt="Flight Image" style="height: 250px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">
                                                    <?php echo htmlspecialchars($flight['departure']) . " to " . htmlspecialchars($flight['arrival']); ?>
                                                </h5>
                                                <p class="card-text text-center">Price: LKR<?php echo htmlspecialchars($flight['price']); ?></p>
                                                <div class="d-flex justify-content-center">
                                                    <!-- Check if the user is logged in before allowing booking -->
                                                    <a href="<?php echo isset($_SESSION['user_id']) ? 'book.php?flight_id=' . $flight['id'] : 'login.php'; ?>" class="btn btn-primary btn-lg px-4">
                                                        Book Now
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#flightCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#flightCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php else: ?>
            <p class="text-center text-danger">No flights available at the moment.</p>
        <?php endif; ?>
    </div>
</div>
<!-- Flight Selection Section End -->

<?php
// Close the database connection
$conn->close();
?>

<?php
require 'footer.php';
?>

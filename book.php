<?php
include("dbconn.php");

// Fetch flight details based on the selected flight_id
$flight_id = isset($_GET['flight_id']) ? intval($_GET['flight_id']) : 0;
$sql = "SELECT * FROM flights WHERE id = $flight_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $flight = $result->fetch_assoc();
} else {
    echo "Flight not found.";
    exit;
}
?>

<?php
    require 'header.php';
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5">
        <div class="container"><br><br>
            <h1 class="display-3 mb-4">Booking Details</h1>
            <p>Review the flight details and proceed with your booking.</p>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Booking Form Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <form>
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Flight Details</h5>
                        <p><strong>Flight Number:</strong> <?php echo htmlspecialchars($flight['flight_no']); ?></p>
                        <p><strong>Departure:</strong> <?php echo htmlspecialchars($flight['departure']); ?></p>
                        <p><strong>Arrival:</strong> <?php echo htmlspecialchars($flight['arrival']); ?></p>
                        <p><strong>Departure Time:</strong> <?php echo htmlspecialchars($flight['departure_time']); ?></p>
                        <p><strong>Arrival Time:</strong> <?php echo htmlspecialchars($flight['arrival_time']); ?></p>
                        <p><strong>Duration:</strong> <?php echo htmlspecialchars($flight['duration']); ?></p>
                        <p><strong>Stops:</strong> <?php echo htmlspecialchars($flight['stops']); ?></p>
                        <p><strong>Price:</strong> $<?php echo htmlspecialchars($flight['price']); ?></p>
                    </div>

                    <div class="col-lg-6">
                        <h5>Passenger Details</h5>
                        <div class="mb-3">
                            <label for="adults" class="form-label">Number of Adults</label>
                            <input type="number" class="form-control" id="adults" name="adults" required min="1" value="1">
                        </div>
                        <div class="mb-3">
                            <label for="children" class="form-label">Number of Children</label>
                            <input type="number" class="form-control" id="children" name="children" min="0" value="0">
                        </div>
                        <p><strong>Total Price:</strong> <span id="total_price">$<?php echo htmlspecialchars($flight['price']); ?></span></p>
                        <input type="hidden" id="flight_id" name="flight_id" value="<?php echo $flight['id']; ?>">
                        <input type="hidden" id="calculated_price" name="calculated_price" value="<?php echo htmlspecialchars($flight['price']); ?>">
                        <a href="#" id="proceed_to_payment" class="btn btn-primary">Proceed to Payment</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Booking Form End -->

    <?php
    require 'footer.php';
?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const pricePerPerson = <?php echo htmlspecialchars($flight['price']); ?>;
        const adultsInput = document.getElementById("adults");
        const childrenInput = document.getElementById("children");
        const totalPriceSpan = document.getElementById("total_price");
        const proceedButton = document.getElementById("proceed_to_payment");
        const calculatedPriceInput = document.getElementById("calculated_price");

        function updateTotalPrice() {
            const adults = parseInt(adultsInput.value) || 0;
            const children = parseInt(childrenInput.value) || 0;
            const totalPrice = (adults + children) * pricePerPerson;

            totalPriceSpan.textContent = `$${totalPrice}`;
            calculatedPriceInput.value = totalPrice;

            // Update the href attribute of the "Proceed to Payment" button
            const flightId = document.getElementById("flight_id").value;
            proceedButton.href = `flight_booking_payment.php?flight_id=${flightId}&total_price=${totalPrice}`;
        }

        // Attach event listeners to update the total price on input change
        adultsInput.addEventListener("input", updateTotalPrice);
        childrenInput.addEventListener("input", updateTotalPrice);

        // Initialize the total price on page load
        updateTotalPrice();
    </script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>

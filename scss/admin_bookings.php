<?php
include("dbconn.php");

// Handle form submission for adding flights
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add a new flight
    if (isset($_POST['add_flight'])) {
        $flight_no = $_POST['flight_no'];
        $departure = $_POST['departure'];
        $arrival = $_POST['arrival'];
        $departure_time = $_POST['departure_time'];
        $arrival_time = $_POST['arrival_time'];
        $duration = $_POST['duration'];
        $stops = $_POST['stops'];
        $price = $_POST['price'];

        // Handle image upload
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "img/$image");

        // Insert query
        $sql = "INSERT INTO flights (flight_no, departure, arrival, departure_time, arrival_time, duration, stops, price, image)
                VALUES ('$flight_no', '$departure', '$arrival', '$departure_time', '$arrival_time', '$duration', '$stops', '$price', '$image')";

        if ($conn->query($sql) === true) {
            header("Location: admin_bookings.php");
            exit();
        } else {
            echo "Error adding flight: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Travels</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="admin_img/icons/icon.png">
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-plane"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sky Travels</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="admin_panel.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item active">
                <a class="nav-link" href="admin_bookings.php">
                    <i class="fas fa-fw fa-plane"></i>
                    <span>Manage Flights</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
        </ul>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="admin_dashboard.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="admin_logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Main Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Manage Flights</h1>

                    <!-- Add Flight Form -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Flight</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="flight_no">Flight Number</label>
                                    <input type="text" class="form-control" id="flight_no" name="flight_no" placeholder="Flight Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="departure">Departure Location</label>
                                    <input type="text" class="form-control" id="departure" name="departure" placeholder="Departure Location" required>
                                </div>
                                <div class="form-group">
                                    <label for="arrival">Arrival Location</label>
                                    <input type="text" class="form-control" id="arrival" name="arrival" placeholder="Arrival Location" required>
                                </div>
                                <div class="form-group">
                                    <label for="departure_time">Departure Time</label>
                                    <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" required>
                                </div>
                                <div class="form-group">
                                    <label for="arrival_time">Arrival Time</label>
                                    <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" required>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration" required>
                                </div>
                                <div class="form-group">
                                    <label for="stops">Number of Stops</label>
                                    <input type="number" class="form-control" id="stops" name="stops" placeholder="Stops" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Flight Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image" required>
                                </div>
                                <button type="submit" name="add_flight" class="btn btn-primary btn-block">Add Flight</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- End of Main Content -->
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

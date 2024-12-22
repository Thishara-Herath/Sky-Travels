<?php
include("dbconn.php");

if (isset($_GET['id'])) {
    $flight_id = $_GET['id'];

    // Fetch flight data for the given ID
    $sql = "SELECT * FROM flights WHERE id = $flight_id";
    $result = $conn->query($sql);
    $flight = $result->fetch_assoc();

    // Handle form submission for editing the flight
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $flight_no = $_POST['flight_no'];
        $departure = $_POST['departure'];
        $arrival = $_POST['arrival'];
        $departure_time = $_POST['departure_time'];
        $arrival_time = $_POST['arrival_time'];
        $duration = $_POST['duration'];
        $stops = $_POST['stops'];
        $price = $_POST['price'];

        // Handle image upload if a new image is provided
        if ($_FILES['image']['name']) {
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($image_tmp, "img/$image");

            // Delete old image if exists
            if ($flight['image'] && file_exists("img/{$flight['image']}")) {
                unlink("img/{$flight['image']}");
            }
        } else {
            $image = $flight['image'];  // Retain the old image if no new image is uploaded
        }

        // Update query
        $sql = "UPDATE flights SET
                flight_no = '$flight_no', departure = '$departure', arrival = '$arrival', 
                departure_time = '$departure_time', arrival_time = '$arrival_time', 
                duration = '$duration', stops = '$stops', price = '$price', image = '$image'
                WHERE id = $flight_id";

        if ($conn->query($sql) === TRUE) {
            header("Location: admin_flights.php");
            exit();
        } else {
            echo "Error updating flight: " . $conn->error;
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
            <li class="nav-item">
                <a class="nav-link" href="completed_payments.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Completed Payments</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="edit_flight.php">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Edit Flight</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
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
                <!-- End Topbar -->

                <!-- Main Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Flight</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Flight Details</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="flight_no">Flight Number</label>
                                    <input type="text" class="form-control" id="flight_no" name="flight_no" value="<?php echo $flight['flight_no']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="departure">Departure Location</label>
                                    <input type="text" class="form-control" id="departure" name="departure" value="<?php echo $flight['departure']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="arrival">Arrival Location</label>
                                    <input type="text" class="form-control" id="arrival" name="arrival" value="<?php echo $flight['arrival']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="departure_time">Departure Time</label>
                                    <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" value="<?php echo $flight['departure_time']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="arrival_time">Arrival Time</label>
                                    <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" value="<?php echo $flight['arrival_time']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $flight['duration']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="stops">Stops</label>
                                    <input type="number" class="form-control" id="stops" name="stops" value="<?php echo $flight['stops']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $flight['price']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Flight Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sky Travels 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>

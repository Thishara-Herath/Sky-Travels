<?php
include('dbconn.php');

// Check if the ID is passed to the page
if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    // Fetch the existing details of the package
    $sql = "SELECT * FROM packages WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $package_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $package = $result->fetch_assoc();
        } else {
            echo "<script>alert('Package not found.');</script>";
            exit;
        }

        $stmt->close();
    }
} else {
    echo "<script>alert('No package ID provided.');</script>";
    exit;
}

// Handle form submission for updating the package
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $destination = $_POST['destination'];
    $duration = $_POST['duration'];
    $ideal_for = $_POST['ideal_for'];
    $price = $_POST['price'];

    $target_dir = "img/packages/";
    if ($_FILES['image']['name']) {
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        } else {
            echo "<script>alert('Error uploading the file.');</script>";
            exit;
        }
    } else {
        $image = $package['image'];
    }

    $sql = "UPDATE packages SET 
                title = ?, 
                description = ?, 
                destination = ?, 
                duration = ?, 
                ideal_for = ?, 
                price = ?, 
                image = ? 
            WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssi", $title, $description, $destination, $duration, $ideal_for, $price, $image, $package_id);

        if ($stmt->execute()) {
            echo "<script>alert('Package updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating package.');</script>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Travels</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
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
            <li class="nav-item active">
                <a class="nav-link" href="manage_packages.php">
                    <i class="fas fa-fw fa-suitcase"></i>
                    <span>Manage Packages</span>
                </a>
            </li>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
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

                <!-- Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Package</h1>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $package['title']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required><?php echo $package['description']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Destination</label>
                            <input type="text" name="destination" class="form-control" value="<?php echo $package['destination']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Duration</label>
                            <input type="text" name="duration" class="form-control" value="<?php echo $package['duration']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Ideal For</label>
                            <input type="text" name="ideal_for" class="form-control" value="<?php echo $package['ideal_for']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" value="<?php echo $package['price']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Package</button>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sky Travels 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>

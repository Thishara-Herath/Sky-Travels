<?php
include('dbconn.php');

// Handle form submission for adding or updating packages
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $destination = $_POST['destination'];
    $duration = $_POST['duration'];
    $ideal_for = $_POST['ideal_for'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    if (!empty($image)) {
        $imagePath = 'img/packages/' . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    if ($id) {
        $sql = "UPDATE packages SET 
                    title='$title',
                    description='$description',
                    destination='$destination',
                    duration='$duration',
                    ideal_for='$ideal_for',
                    price='$price',
                    image=IF('$image' != '', '$image', image)
                WHERE id=$id";
    } else {
        $sql = "INSERT INTO packages (title, description, destination, duration, ideal_for, price, image) 
                VALUES ('$title', '$description', '$destination', '$duration', '$ideal_for', '$price', '$image')";
    }

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Package saved successfully!");</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
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
            <li class="nav-item active">
                <a class="nav-link" href="manage_packages.php">
                    <i class="fas fa-fw fa-suitcase"></i>
                    <span>Add Packages</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="admin_dashboard.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="admin_logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Add Packages</h1>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="package-id">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" id="package-title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" id="package-description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Destination</label>
                            <input type="text" name="destination" id="package-destination" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Duration</label>
                            <input type="text" name="duration" id="package-duration" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Ideal For</label>
                            <input type="text" name="ideal_for" id="package-ideal-for" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" name="price" id="package-price" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" id="package-image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Package</button>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

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
    <!-- End of Content Wrapper -->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>

<?php
// Include the database connection file
include 'dbconn.php';

// Handle approval or rejection of stories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = intval($_POST['id']); // Sanitize input
    $action = $_POST['action'];

    $status = $action === 'approve' ? 'approved' : ($action === 'reject' ? 'rejected' : null);

    if ($status) {
        $stmt = $conn->prepare("UPDATE traveler_stories SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Story $status successfully.');
                    window.location.href = 'admin_moderation.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                    window.location.href = 'admin_moderation.php';
                  </script>";
        }
        $stmt->close();
    }
}

// Fetch stories grouped by status
$pendingStories = $conn->query("SELECT * FROM traveler_stories WHERE status = 'pending'");
$approvedStories = $conn->query("SELECT * FROM traveler_stories WHERE status = 'approved'");
$rejectedStories = $conn->query("SELECT * FROM traveler_stories WHERE status = 'rejected'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sky Travels</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="admin_img/icons/icon.png">
    <style>
        .story-card {
    width: 100%;
    max-width: 400px;
    height: 500px;
    margin: 50px 10px; /* Add vertical and horizontal spacing */
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}


        .story-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .story-card-body {
            padding: 15px;
            overflow: auto;
            flex-grow: 1;
        }

        .story-actions {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .story-actions button {
            width: 48%;
        }

        button {
    text-align: center !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}



    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
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
                <a class="nav-link" href="admin_moderation.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Traveler stories</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
        </ul>
        <!-- End Sidebar -->


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
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- <h1 class="h3 mb-4 text-gray-800">Moderate Stories</h1> -->

                    <!-- Pending Stories -->
                    <h2>Pending Stories</h2>
                    <div class="row">
                        <?php while ($row = $pendingStories->fetch_assoc()): ?>
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="story-card shadow">
                                    <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="Story Image">
                                    <div class="story-card-body">
                                        <h5><b><?= htmlspecialchars($row['destination']); ?></b></h5>
                                        <p><strong>Story:</strong> <?= nl2br(htmlspecialchars($row['story_text'])); ?></p>
                                        <p><strong>Travel Tips:</strong> <?= nl2br(htmlspecialchars($row['travel_tips'])); ?></p>
                                    </div>
                                    <div class="story-actions">
                                        <form action="admin_moderation.php" method="POST" style="margin: 0;">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <button class="btn btn-success btn-md" name="action" value="approve">Approve</button>
                                            <button class="btn btn-danger btn-md" name="action" value="reject">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Approved Stories -->
                    <h2>Approved Stories</h2>
                    <div class="row">
                        <?php while ($row = $approvedStories->fetch_assoc()): ?>
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="story-card shadow border-left-success">
                                    <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="Story Image">
                                    <div class="story-card-body">
                                        <h5><b><?= htmlspecialchars($row['destination']); ?></b> <span class="badge badge-success">Approved</span></h5>
                                        <p><strong>Story:</strong> <?= nl2br(htmlspecialchars($row['story_text'])); ?></p>
                                        <p><strong>Travel Tips:</strong> <?= nl2br(htmlspecialchars($row['travel_tips'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Rejected Stories -->
                    <h2>Rejected Stories</h2>
                    <div class="row">
                        <?php while ($row = $rejectedStories->fetch_assoc()): ?>
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="story-card shadow border-left-danger">
                                    <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="Story Image">
                                    <div class="story-card-body">
                                        <h5><b><?= htmlspecialchars($row['destination']); ?> </b><span class="badge badge-danger">Rejected</span></h5>
                                        <p><strong>Story:</strong> <?= nl2br(htmlspecialchars($row['story_text'])); ?></p>
                                        <p><strong>Travel Tips:</strong> <?= nl2br(htmlspecialchars($row['travel_tips'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
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

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>

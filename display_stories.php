<?php
include 'dbconn.php';
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$user_id = $is_logged_in ? $_SESSION['user_id'] : null;

// Fetch only approved traveler stories and their like status for the logged-in user
$query = "SELECT ts.*, 
          IF(sl.id IS NULL, 0, 1) AS user_liked
          FROM traveler_stories ts
          LEFT JOIN story_likes sl 
          ON ts.id = sl.story_id AND sl.user_id = ?
          WHERE ts.status = 'approved'"; // Ensure only approved stories are fetched
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sky Travels</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="admin_img/icons/icon.png">

    <style>
        .custom-image {
            max-height: 300px;
            width: 100%;
            object-fit: cover;
        }

        .custom-card {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <!-- Include the header -->
    <?php require "header.php"; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container"><br><br>
            <h1 class="display-3 mb-4 animated slideInDown">Traveler Stories</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Traveler Stories</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Traveler Stories Section Start -->
    <div class="container py-5">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 mb-4">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h3 class="card-title text-primary"><?= htmlspecialchars($row['destination']) ?></h3>
                            <?php if (!empty($row['image_path'])): ?>
                                <img src="<?= htmlspecialchars($row['image_path']) ?>" 
                                     class="img-fluid rounded custom-image mb-3" alt="Travel Photo">
                            <?php endif; ?>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row['story_text'])) ?></p>
                            <p><strong>Travel Tips:</strong> <?= htmlspecialchars($row['travel_tips']) ?></p>
                            <p><strong>Likes:</strong> <?= $row['likes'] ?></p>
                            <?php if ($is_logged_in): ?>
                                <form action="like_story.php" method="post">
                                    <input type="hidden" name="story_id" value="<?= $row['id'] ?>">
                                    <button type="submit" 
                                            class="btn btn-<?= $row['user_liked'] ? 'danger' : 'outline-primary' ?>">
                                        <?= $row['user_liked'] ? 'Unlike' : 'Like' ?>
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-outline-primary">Like</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- Traveler Stories Section End -->

    <!-- Include the footer -->
    <?php require "footer.php"; ?>

    <!-- Bootstrap Bundle JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

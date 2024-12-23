<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Finanza - Financial Services Website Template</title>
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

    <style>
        .review-card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #fff;
            margin-top: 30px;
            transition: 0.3s ease-in-out;
        }

        .review-card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .review-card h1,
        .review-card h5 {
            font-family: 'Jost', sans-serif;
            color: #333;
        }

        .review-card h5 {
            font-size: 1.5rem;
        }

        .review-card form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .review-card label {
            font-size: 1rem;
            color: #555;
            font-weight: 600;
        }

        .review-card .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 1rem;
            color: #555;
        }

        .review-card textarea.form-control {
            height: 120px;
            resize: vertical;
        }

        .review-card button {
            background-color: #007bff;
            color: #fff;
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
            border: none;
            transition: 0.3s ease;
            cursor: pointer;
        }

        .review-card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php require "header.php"; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container"><br><br>
            <h1 class="display-3 mb-4 animated slideInDown">Add Story</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Add Story</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Review Form Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 mx-auto">
                    <div class="review-card">
                        
                        <h1 class="mb-4">Submit Your Story</h1>
                        <form action="submit_story.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="destination" class="form-label">Destination:</label>
                                <input type="text" class="form-control" id="destination" name="destination" required>
                            </div>
                            <div class="mb-3">
                                <label for="story" class="form-label">Your Story:</label>
                                <textarea class="form-control" id="story" name="story" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tips" class="form-label">Travel Tips:</label>
                                <textarea class="form-control" id="tips" name="tips"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image:</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit Story</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Review Form End -->

    <?php require "footer.php"; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

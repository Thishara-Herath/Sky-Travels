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

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<?php

require "header.php";

?>


    <!-- Spinner Start -->
    <!-- <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div> -->
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <!-- <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</small>
                <small class="ms-4"><i class="fa fa-clock text-primary me-2"></i>9.00 am - 9.00 pm</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small><i class="fa fa-envelope text-primary me-2"></i>info@example.com</small>
                <small class="ms-4"><i class="fa fa-phone-alt text-primary me-2"></i>+012 345 6789</small>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="display-5 text-primary m-0">Finanza</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Services</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu border-light m-0">
                            <a href="project.html" class="dropdown-item">Projects</a>
                            <a href="feature.html" class="dropdown-item">Features</a>
                            <a href="team.html" class="dropdown-item">Team Member</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-none d-lg-flex ms-2">
                    <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                        <small class="fab fa-facebook-f text-primary"></small>
                    </a>
                    <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                        <small class="fab fa-twitter text-primary"></small>
                    </a>
                    <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                        <small class="fab fa-linkedin-in text-primary"></small>
                    </a>
                </div>
            </div>
        </nav>
    </div> -->
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-8">
                                    <p
                                        class="d-inline-block border border-white rounded text-white fw-semi-bold py-1 px-3 animated slideInDown">
                                        Welcome to Sky Travels</p>
                                    <h1 class="display-1 mb-4 animated slideInDown">Experience the world like never before
                                    </h1>
                                    <a href="testimonials.php" class="btn btn-primary py-3 px-5 animated slideInDown">Explore More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7">
                                    <p
                                        class="d-inline-block border border-white rounded text-white fw-semi-bold py-1 px-3 animated slideInDown">
                                        Welcome to Sky Travels</p>
                                    <h1 class="display-1 mb-4 animated slideInDown">Let your journey begin with us</h1>
                                    <a href="about.php" class="btn btn-primary py-3 px-5 animated slideInDown">Explore More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4 align-items-end mb-4">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <img class="img-fluid rounded" src="img/about.jpg" alt="Sky Travels">
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">About Us</p>
                <h1 class="display-5 mb-4">Your Gateway to Memorable Journeys</h1>
                <p class="mb-4">At Sky Travels, we are passionate about creating unforgettable travel experiences for our clients. From luxurious getaways to adventurous escapes, we offer personalized travel services to cater to your every need. With a dedicated team and years of expertise, we aim to make every trip extraordinary and stress-free.</p>
                <div class="border rounded p-4">
                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link fw-semi-bold active" id="nav-story-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-story" type="button" role="tab" aria-controls="nav-story"
                                aria-selected="true">Our Story</button>
                            <button class="nav-link fw-semi-bold" id="nav-mission-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-mission" type="button" role="tab" aria-controls="nav-mission"
                                aria-selected="false">Our Mission</button>
                            <button class="nav-link fw-semi-bold" id="nav-vision-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-vision" type="button" role="tab" aria-controls="nav-vision"
                                aria-selected="false">Our Vision</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-story" role="tabpanel"
                            aria-labelledby="nav-story-tab">
                            <p>Sky Travels was founded with the idea of making travel easier and more accessible. Over the years, we have built a reputation for providing expert advice and high-quality service to travelers across the world.</p>
                            <p class="mb-0">We started as a small local agency and have grown to become one of the most trusted travel partners for individuals and families looking to create beautiful memories through travel.</p>
                        </div>
                        <div class="tab-pane fade" id="nav-mission" role="tabpanel"
                            aria-labelledby="nav-mission-tab">
                            <p>Our mission is to offer personalized travel solutions that meet the needs of every customer, ensuring their trips are seamless and memorable. We strive to provide excellent customer service, competitive prices, and a variety of travel options for all types of travelers.</p>
                            <p class="mb-0">By understanding our clients' preferences, we aim to provide custom itineraries that turn travel dreams into reality, making each journey a unique experience.</p>
                        </div>
                        <div class="tab-pane fade" id="nav-vision" role="tabpanel" aria-labelledby="nav-vision-tab">
                            <p>Our vision is to become the leading travel agency in the world by providing world-class services, building lasting relationships with our customers, and continuously innovating in the travel industry.</p>
                            <p class="mb-0">We want to inspire people to explore the world and experience diverse cultures, all while maintaining a high standard of service and ensuring every traveler’s satisfaction.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border rounded p-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-4">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-plane-departure text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Tailored Travel Packages</h4>
                                <span>From exotic beach holidays to thrilling mountain expeditions, we design travel packages suited to your preferences.</span>
                            </div>
                            <div class="border-end d-none d-lg-block"></div>
                        </div>
                        <div class="border-bottom mt-4 d-block d-lg-none"></div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="h-100">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-users text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Expert Travel Consultants</h4>
                                <span>Our team of experienced consultants is here to guide you through every step of your journey, ensuring a smooth experience.</span>
                            </div>
                            <div class="border-end d-none d-lg-block"></div>
                        </div>
                        <div class="border-bottom mt-4 d-block d-lg-none"></div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-headset text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h4>24/7 Customer Support</h4>
                                <span>Our support team is available round the clock to assist you with bookings, travel advice, or any inquiries.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


   <!-- Facts Start -->
<div class="container-fluid facts my-5 py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                <i class="fa fa-users fa-3x text-white mb-3"></i>
                <h1 class="display-4 text-white" data-toggle="counter-up">100</h1>
                <span class="fs-5 text-white">Happy Clients</span>
                <hr class="bg-white w-25 mx-auto mb-0">
            </div>
            <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                <i class="fa fa-plane-departure fa-3x text-white mb-3"></i>
                <h1 class="display-4 text-white" data-toggle="counter-up">40</h1>
                <span class="fs-5 text-white">Trips Organized</span>
                <hr class="bg-white w-25 mx-auto mb-0">
            </div>
            <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                <i class="fa fa-users-cog fa-3x text-white mb-3"></i>
                <h1 class="display-4 text-white" data-toggle="counter-up">50</h1>
                <span class="fs-5 text-white">Dedicated Travel Experts</span>
                <hr class="bg-white w-25 mx-auto mb-0">
            </div>
            <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                <i class="fa fa-trophy fa-3x text-white mb-3"></i>
                <h1 class="display-4 text-white" data-toggle="counter-up">2</h1>
                <span class="fs-5 text-white">Awards and Recognitions</span>
                <hr class="bg-white w-25 mx-auto mb-0">
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->



   <!-- Features Start -->
<div class="container-xxl feature py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Why Choose Sky Travels!</p>
                <h1 class="display-5 mb-4">Why People Choose Sky Travels!</h1>
                <p class="mb-4">At Sky Travels, we are dedicated to offering seamless and unforgettable travel experiences. Our personalized services and attention to detail make us a top choice for travelers seeking comfort, reliability, and adventure. Whether it's a relaxing holiday or an adventurous exploration, we ensure every journey is memorable.</p>
                <a class="btn btn-primary py-3 px-5" href="testimonials.php">Explore More</a>
            </div>
            <div class="col-lg-6">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <div class="row g-4">
                            <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                <div class="feature-box border rounded p-4">
                                    <i class="fa fa-check fa-3x text-primary mb-3"></i>
                                    <h4 class="mb-3">Fast and Reliable Service</h4>
                                    <p class="mb-3">We ensure quick and efficient travel arrangements, with no delays, ensuring that your travel experience is as smooth as possible.</p>
                                   
                                </div>
                            </div>
                            <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                <div class="feature-box border rounded p-4">
                                    <i class="fa fa-check fa-3x text-primary mb-3"></i>
                                    <h4 class="mb-3">Expert Guidance & Support</h4>
                                    <p class="mb-3">Our team of travel experts provides personalized guidance and support throughout your journey, ensuring a hassle-free experience.</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                        <div class="feature-box border rounded p-4">
                            <i class="fa fa-check fa-3x text-primary mb-3"></i>
                            <h4 class="mb-3">Financial Security</h4>
                            <p class="mb-3">Sky Travels ensures financial security with fully transparent pricing and secure payment options, providing peace of mind for every traveler.</p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->



   




    


        
<?php

require "footer.php";

?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


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
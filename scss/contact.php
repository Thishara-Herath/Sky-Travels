<?php
session_start();

// Database connection
include('dbconn.php');

// Fetch chat history for the logged-in user if they are logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM chats WHERE user_id = ? ORDER BY created_at ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
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

    <!-- Styling for the floating chat button and popup -->
    <style>
        .chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .chat-popup {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            z-index: 9999;
        }

        .chat-header {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .chat-history {
            height: 200px;
            overflow-y: auto;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
        }

        .chat-history div {
            margin-bottom: 10px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: #000;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php require "header.php"; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container"><br><br>
            <h1 class="display-3 mb-4 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Info -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Contact</p>
                    <h1 class="display-5 mb-4">If You Have Any Query, Please Contact Us</h1>
                    
                    <form class="p-4 border rounded bg-light shadow-sm">
                        <div class="row g-4">
                            <!-- Email Address -->
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-envelope text-primary me-3"></i>
                                    <span class="fw-bold">Email Address:</span>
                                    <span class="ms-2">info@gmail.com</span>
                                </div>
                            </div>
                            <!-- Phone Number -->
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-phone text-primary me-3"></i>
                                    <span class="fw-bold">Phone:</span>
                                    <span class="ms-2">+94 89 55488 55</span>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-map-marker-alt text-primary me-3"></i>
                                    <span class="fw-bold">Address:</span>
                                    <span class="ms-2">Sky Travels, 456 Colombo Road, Colombo, Sri Lanka</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Google Map -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe class="position-relative w-100 h-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63315.35788320796!2d79.8359335511187!3d6.927079412164194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2593bd1d1ed8f%3A0xb1c5e60c08b7f121!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2sbd!4v1699601894173!5m2!1sen!2sbd" 
                            frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Floating Chat Icon -->
    <!-- <div class="chat-icon">
        <button id="chatButton" class="btn btn-primary" onclick="openChat()">
            <i class="fa fa-comments"></i> Chat
        </button>
    </div> -->

    <!-- Chat Popup -->
    <div id="chatPopup" class="chat-popup">
        <div class="chat-header">
            <span>Chat with Admin</span>
            <button class="close-btn" onclick="closeChat()">&times;</button>
        </div>
        <div id="chatHistory" class="chat-history">
            <!-- Chat messages will be displayed here -->
        </div>
        <textarea id="userMessage" class="form-control" placeholder="Type your message..."></textarea>
        <button class="btn btn-primary" onclick="sendMessage()">Send</button>
    </div>

    <!-- JavaScript for chat functionality -->
    <script>
        // Function to open chat
        function openChat() {
            <?php if (isset($_SESSION['user_id'])): ?>
                // If the user is logged in, open the chat popup
                document.getElementById('chatPopup').style.display = 'block';
                loadChatHistory();
            <?php else: ?>
                // If not logged in, redirect to the login page
                window.location.href = 'login.php';
            <?php endif; ?>
        }

        // Function to close chat
        function closeChat() {
            document.getElementById('chatPopup').style.display = 'none';
        }

        // Function to load chat history from the database
        function loadChatHistory() {
            // AJAX call to fetch chat history for the logged-in user
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_chat.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('chatHistory').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Function to send a message
        function sendMessage() {
            var message = document.getElementById('userMessage').value;
            if (message.trim() === '') return;

            // Send message via AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'send_message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('userMessage').value = '';
                    loadChatHistory();
                }
            };
            xhr.send('message=' + encodeURIComponent(message));
        }
    </script>

    <?php require "footer.php"; ?>
</body>

</html>

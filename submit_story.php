<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form inputs and sanitize them
    $destination = $conn->real_escape_string($_POST['destination']);
    $story = $conn->real_escape_string($_POST['story']);
    $tips = $conn->real_escape_string($_POST['tips']);
    $image_path = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "uploads/";
        $image_name = basename($_FILES["image"]["name"]);
        $image_path = $upload_dir . $image_name;

        // Ensure the upload directory exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
            echo "<script>
                    alert('Error uploading image. Please try again.');
                    window.location.href = 'travel_story.php';
                  </script>";
            exit();
        }
    }

    $user_id = 1; // Assume logged-in user's ID for demonstration
    $sql = "INSERT INTO traveler_stories (user_id, destination, story_text, image_path, travel_tips) 
            VALUES ('$user_id', '$destination', '$story', '$image_path', '$tips')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Story submitted successfully! Await admin approval.');
                setTimeout(function() {
                    window.location.href = 'travel_story.php';
                }, 1000);
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $conn->error . "');
                setTimeout(function() {
                    window.location.href = 'travel_story.php';
                }, 1000);
              </script>";
    }
}
?>

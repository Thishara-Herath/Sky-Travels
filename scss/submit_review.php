<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $message = $_POST['message'];
    $profilePhotoUrl = '';

    // Handle file upload
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_photo']['tmp_name'];
        $fileName = $_FILES['profile_photo']['name'];
        $fileSize = $_FILES['profile_photo']['size'];
        $fileType = $_FILES['profile_photo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $uploadFileDir = './uploaded_photos/';
        $dest_path = $uploadFileDir . $newFileName;

        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $profilePhotoUrl = $dest_path;
        } else {
            echo '<script>alert("There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.");</script>';
            exit;
        }
    } else {
        echo '<script>alert("There was some error in the file upload. Error: ' . $_FILES['profile_photo']['error'] . '");</script>';
        exit;
    }

    // Insert data into the database
    if (!empty($profilePhotoUrl)) {
        $stmt = $conn->prepare("INSERT INTO reviews (name, designation, profile_photo, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $designation, $profilePhotoUrl, $message);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Review submitted successfully.");
                    window.location.href = "review_form.php";
                  </script>';
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
    }
}

$conn->close();
?>

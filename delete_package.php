<?php
// Include database connection
include('dbconn.php');

// Check if the ID is passed to the page
if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    // Prepare the SQL query to delete the package
    $sql = "DELETE FROM packages WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $package_id);
        
        if ($stmt->execute()) {
            echo "<p class='message success'>Package deleted successfully.</p>";
        } else {
            echo "<p class='message error'>Error deleting package.</p>";
        }

        $stmt->close();
    } else {
        echo "<p class='message error'>Error preparing the delete query.</p>";
    }
} else {
    echo "<p class='message error'>No package ID provided.</p>";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Package</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f8ff; /* Light blue background */
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #333;
            padding: 20px;
            background-color: #87CEEB; /* Light blue header */
            margin: 0;
        }

        .message {
            text-align: center;
            font-size: 18px;
            padding: 10px;
            margin-top: 20px;
        }

        .success {
            color: #32CD32; /* Green for success */
        }

        .error {
            color: #FF6347; /* Tomato red for error */
        }

        /* Links Styling */
        a {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            background-color: #87CEEB;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #1E90FF; /* Darker blue on hover */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            a {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>

    <h1>Delete Package</h1>
    <p class="message">Are you sure you want to delete this package?</p>
    <a href="delete_package.php?id=<?php echo $_GET['id']; ?>" class="delete-link">Yes, delete this package</a>
    <a href="manage_packages.php" class="back-link">No, go back to the package list</a>

</body>
</html>

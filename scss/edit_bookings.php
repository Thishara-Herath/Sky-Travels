<?php
// Include the db_connection.php file
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_booking'])) {
    // Get booking details from the form
    $id = $_POST['flight_id'];
    $flight_no = $_POST['flight_no'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $duration = $_POST['duration'];
    $stops = $_POST['stops'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    // If a new image is uploaded, handle it
    if ($image) {
        $target = "img/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE flights SET flight_no = ?, departure = ?, arrival = ?, departure_time = ?, arrival_time = ?, duration = ?, stops = ?, price = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$flight_no, $departure, $arrival, $departure_time, $arrival_time, $duration, $stops, $price, $image, $id]);
    } else {
        // If no new image, just update other fields
        $sql = "UPDATE flights SET flight_no = ?, departure = ?, arrival = ?, departure_time = ?, arrival_time = ?, duration = ?, stops = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$flight_no, $departure, $arrival, $departure_time, $arrival_time, $duration, $stops, $price, $id]);
    }

    // Redirect back to the view bookings page
    header('Location: view_bookings.php');
    exit();
} elseif (isset($_GET['id'])) {
    // Fetch the booking details to populate the form
    $id = $_GET['id'];
    $sql = "SELECT * FROM flights WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $flight = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirect if no flight ID is provided
    header('Location: view_bookings.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Travels</title>
    <link rel="icon" type="image/png" href="admin_img/icons/icon.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        form input, form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        form button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Edit Flight Booking</h1>
    <form method="post" action="edit_bookings.php" enctype="multipart/form-data">
        <input type="hidden" name="flight_id" value="<?php echo htmlspecialchars($flight['id']); ?>">

        <label for="flight_no">Flight Number:</label>
        <input type="text" id="flight_no" name="flight_no" value="<?php echo htmlspecialchars($flight['flight_no']); ?>" required><br>

        <label for="departure">Departure:</label>
        <input type="text" id="departure" name="departure" value="<?php echo htmlspecialchars($flight['departure']); ?>" required><br>

        <label for="arrival">Arrival:</label>
        <input type="text" id="arrival" name="arrival" value="<?php echo htmlspecialchars($flight['arrival']); ?>" required><br>

        <label for="departure_time">Departure Time:</label>
        <input type="datetime-local" id="departure_time" name="departure_time" value="<?php echo htmlspecialchars($flight['departure_time']); ?>" required><br>

        <label for="arrival_time">Arrival Time:</label>
        <input type="datetime-local" id="arrival_time" name="arrival_time" value="<?php echo htmlspecialchars($flight['arrival_time']); ?>" required><br>

        <label for="duration">Duration:</label>
        <input type="text" id="duration" name="duration" value="<?php echo htmlspecialchars($flight['duration']); ?>" required><br>

        <label for="stops">Stops:</label>
        <input type="number" id="stops" name="stops" value="<?php echo htmlspecialchars($flight['stops']); ?>" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($flight['price']); ?>" required><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br>

        <button type="submit" name="update_booking">Update Booking</button>
    </form>
</body>
</html>
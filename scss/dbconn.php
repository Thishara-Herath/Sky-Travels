<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Sky_Travels";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // echo "Connected successfully";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit(); // Exit script if there's an error
}
?>

<?php
include("dbconn.php");
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in both fields.";
        header("Location: login.php");
        exit();
    } else {
        // Check user table
        $stmt_user = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
        $stmt_user->bind_param("ss", $email, $password);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($result_user->num_rows > 0) {
            $row = $result_user->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['mobile'] = $row['mobile'];
            $_SESSION['user_id'] = $row['id'];  // Changed to user_id for consistency
            $_SESSION['username'] = $row['firstname'];  // Added username for consistency with header.php
            $_SESSION['role'] = 'user'; // Setting role to user
            header("Location: index.php");
            exit();
        } else {
            // Optionally, check admin table (commented out code)
            // $stmt_admin = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
            // $stmt_admin->bind_param("ss", $email, $password);
            // $stmt_admin->execute();
            // $result_admin = $stmt_admin->get_result();

            // if ($result_admin->num_rows > 0) {
            //     $row = $result_admin->fetch_assoc();
            //     $_SESSION['email'] = $row['email'];
            //     $_SESSION['firstname'] = $row['firstname'];
            //     $_SESSION['lastname'] = $row['lastname'];
            //     $_SESSION['user_id'] = $row['id'];  
            //     $_SESSION['username'] = $row['firstname'];  
            //     $_SESSION['role'] = 'admin'; 
            //     header("Location: adminprofile.php");
            //     exit();
            // } else {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
            // }
        }
    }
}
?>
